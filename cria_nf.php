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

// Obter o nome do cliente do formulário
$cliente_nome = $_POST["cliente_nome"];

// Consultar o banco de dados para obter o ID do cliente com base no nome
$consulta_cliente = "SELECT id FROM clientes WHERE nome = '$cliente_nome'";
$resultado_cliente = $conn->query($consulta_cliente);

if ($resultado_cliente->num_rows > 0) {
    // Se o cliente existir, obtenha o ID
    $row = $resultado_cliente->fetch_assoc();
    $cliente_id = $row["id"];
} else {
    // Se o cliente não existir, crie um novo cliente
    $inserir_cliente = "INSERT INTO clientes (nome) VALUES ('$cliente_nome')";
    if ($conn->query($inserir_cliente) === TRUE) {
        // Após a criação do cliente, obtenha o ID do novo cliente
        $cliente_id = $conn->insert_id;
    } else {
        echo "Erro ao criar cliente: " . $conn->error;
        exit; // Encerre o script se houver um erro na criação do cliente
    }
}

// Agora você pode obter os outros dados do formulário
$data_emissao = $_POST["data_emissao"];
$total = $_POST["total"];

// Inserir os dados no banco de dados
$sql = "INSERT INTO notas_fiscais (cliente_id, data_emissao, total) VALUES ('$cliente_id', '$data_emissao', '$total')";

if ($conn->query($sql) === TRUE) {
    echo "Nota fiscal criada com sucesso!";
} else {
    echo "Erro ao criar nota fiscal: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
