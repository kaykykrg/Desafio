<?php
// Conectar ao banco de dados (substitua as informações com as suas)
$servername = "localhost";  // O nome do servidor onde o MySQL está em execução
$username = "root";  // Seu nome de usuário do MySQL
$password = "";             // Deixe a senha em branco temporariamente
$dbname = "banco";          // O nome do banco de dados que você deseja usar


$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


if (isset($_POST['numero_nota_consulta'])) {
    $numero_nota = $_POST['numero_nota_consulta'];

    // Consultar a nota fiscal no banco de dados
    $sql = "SELECT * FROM notas_fiscais WHERE id = $numero_nota";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Exibir as informações da nota fiscal
        echo '<div class="container">';
        echo '<h1>Detalhes da Nota Fiscal</h1>';
        echo '<p><strong>Número da Nota Fiscal:</strong> ' . $row["id"] . '</p>';
        echo '<p><strong>Data de Emissão:</strong> ' . $row["data_emissao"] . '</p>';
        echo '<p><strong>Total:</strong> R$ ' . number_format($row["total"], 2, ',', '.') . '</p>';
        echo '</div>';
    } else {
        echo "Nenhuma nota fiscal encontrada com o número: " . $numero_nota;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>
