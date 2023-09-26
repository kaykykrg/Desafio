-- tabela de clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf_cnpj VARCHAR(20) NOT NULL
);

-- tabela de produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL
);

-- tabela de notas fiscais
CREATE TABLE notas_fiscais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    data_emissao DATE,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

-- tabela de itens de notas fiscais
CREATE TABLE itens_nf (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nota_fiscal_id INT,
    produto_id INT,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (nota_fiscal_id) REFERENCES notas_fiscais(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);
