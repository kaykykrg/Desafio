<?php
// Conectar ao banco de dados (substitua as informações com as suas)
$servername = "localhost";  // O nome do servidor onde o MySQL está em execução
$username = "root";  // Seu nome de usuário do MySQL
$password = "";             // Deixe a senha em branco temporariamente
$dbname = "banco";          // O nome do banco de dados que você deseja usar

// Verificar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar o banco de dados para obter todas as notas fiscais
$sql = "SELECT notas_fiscais.*, clientes.nome AS cliente_nome FROM notas_fiscais
        INNER JOIN clientes ON notas_fiscais.cliente_id = clientes.id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" href="css/fontes e fotos/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/historico.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inteligencia FISCAL</title>
</head>
<body>

    <!-- CABECALHO -->
    
    <header>

        <h1> Consulta e criação de nota Fiscal </h1>
        <p><strong>Visualizar, consultar e administrar suas notas fiscais</strong></p>
        <nav>
            <li>
                <a href="https://www.nfe.fazenda.gov.br/portal/principal.aspx">Site da Fazenda</a>
                <a href="index.html">Home</a>
            </li>
        </nav>
    </header>

    <!-- HISTÓRICO -->

    <main>
        <div>
            <h2> Histórico das Notas Fiscais Eletrônicas </h2>
        </div>
        <div id="hist">
            <p><strong>NOME   | DATA   | PREÇO   | ID</strong></p>
            
            <!-- Loop para exibir cada registro de nota fiscal -->
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row["cliente_nome"] . " | " . $row["data_emissao"] . " | " . $row["total"] . " | " . $row["id"] . "</p>";
            }
            ?>
        </div>
    </main>

    <!-- RODAPÉ -->

    <footer>
        <p>Desenvolvido por DiasKigs e Kruger</p>
    </footer>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
