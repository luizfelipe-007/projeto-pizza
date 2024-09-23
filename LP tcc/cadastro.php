<?php
include_once('config.php');

// Verificar conexão
if ($conexao->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conexao->connect_error);
}

// Receber dados do formulário
if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['data_nascimento']) && isset($_POST['rua']) && isset($_POST['numero']) && isset($_POST['complemento']) && isset($_POST['bairro']) && isset($_POST['cidade']) && isset($_POST['estado']) && isset($_POST['cep'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $data_nascimento = $_POST['data_nascimento'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    // Verificar se o e-mail já existe
    $stmt = $conexao->prepare("SELECT COUNT(*) FROM Usuarios WHERE email = ?");
    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conexao->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo "Erro: E-mail já cadastrado. Tente outro e-mail.";
    } else {
        // Se o e-mail não existir, prosseguir com a inserção
        $stmt = $conexao->prepare("INSERT INTO Usuarios (nome, email, senha, data_nascimento, rua, numero, complemento, bairro, cidade, estado, cep) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $conexao->error);
        }
        // Aqui estamos usando password_hash para criptografar a senha antes de salvar
        $senha_criptografada = password_hash($senha, PASSWORD_BCRYPT);
        $stmt->bind_param("sssssssssss", $nome, $email, $senha, $data_nascimento, $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep);

        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o usuário: " . $stmt->error;
        }
        $stmt->close();
    }
} else {
    echo "Erro: Dados do formulário não enviados corretamente.";
}

$conexao->close();
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pizzaria - Cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <header id="header">
        <h1 id="h1-header">Pizzaria Bem Barato</h1>
        <h3 class="h3-header">A Melhor Pizzaria</h3>

        <nav id="navegacao">
            <a class="link-cabecalho" href="#">Home</a>
            <a class="link-cabecalho" href="#">Pizzas</a>
            <a class="link-cabecalho" href="#">Bebidas</a>
            <a class="link-cabecalho" href="#">Sobremesas</a>
            <a class="link-cabecalho" href="#">Endereço</a>
            <a class="link-cabecalho" href="cadastro.html">Cadastro</a>
        </nav>
    </header>

    <section class="form-container">
        <h2>Cadastro de Usuário</h2>
        <form id="form-cadastro" method="POST" action="cadastro.php">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>

            <label for="rua">Rua:</label>
            <input type="text" id="rua" name="rua">

            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero">

            <label for="complemento">Complemento:</label>
            <input type="text" id="complemento" name="complemento">

            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro">

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade">

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado">

            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep">

            <button type="submit">Cadastrar</button>
        </form>

</html>
