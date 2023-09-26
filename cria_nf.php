<?php
// Conectar ao banco de dados (substitua as informações com as suas)
$servername = "localhost";  // O nome do servidor onde o MySQL está em execução
$username = "root";  // Seu nome de usuário do MySQL
$password = "";             // Deixe a senha em branco temporariamente
$dbname = "banco";          // O nome do banco de dados que você deseja usar

// Dados do cliente (substitua com os dados do cliente)
$cliente_nome = "Nome do Cliente";
$cliente_cpf_cnpj = "1234567890";

// Dados da nota fiscal
$data_emissao = "2023-09-25"; // Data de emissão da nota fiscal
$total = 100.00;               // Total da nota fiscal

// Criar uma conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Iniciar uma transação
$conn->begin_transaction();

// Inserir o cliente se ele não existir
$stmt = $conn->prepare("INSERT INTO clientes (nome, cpf_cnpj) VALUES (?, ?)");
$stmt->bind_param("ss", $cliente_nome, $cliente_cpf_cnpj);

if ($stmt->execute()) {
    $cliente_id = $conn->insert_id; // Obter o ID do cliente recém-criado
} else {
    echo "Erro ao inserir cliente: " . $stmt->error;
    $conn->rollback(); // Reverter a transação em caso de erro
    $conn->close();
    exit();
}

// Inserir a nota fiscal associada ao cliente
$stmt = $conn->prepare("INSERT INTO notas_fiscais (cliente_id, data_emissao, total) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $cliente_id, $data_emissao, $total);

if ($stmt->execute()) {
    echo "Nota fiscal criada com sucesso.";
    $conn->commit(); // Confirmar a transação
} else {
    echo "Erro ao criar a nota fiscal: " . $stmt->error;
    $conn->rollback(); // Reverter a transação em caso de erro
}

// Fechar a conexão com o banco de dados
$conn->close();
?>