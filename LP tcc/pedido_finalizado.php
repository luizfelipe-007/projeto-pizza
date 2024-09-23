<?php
include_once('config.php');

// Pegar os dados do formulário
$pizzas = isset($_POST['pizza']) ? implode(", ", $_POST['pizza']) : 'Nenhuma'; // Combinar as pizzas selecionadas em uma string
$bebida = $_POST['bebida'];
$sobremesa = $_POST['sobremesa'];

// Inserir os dados no banco de dados
$stmt = $conexao->prepare("INSERT INTO pedidos (pizza, bebida, sobremesa) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $pizzas, $bebida, $sobremesa);

if ($stmt->execute()) {
    echo "Pedido realizado com sucesso!<br>";
    echo "<h2>Seu Pedido:</h2>";

    // Exibir imagens relacionadas ao pedido
    echo "<h3>Pizzas</h3>";
    if (isset($_POST['pizza'])) {
        foreach ($_POST['pizza'] as $pizza) {
            echo "<img src='imagens/{$pizza}.png' alt='{$pizza}' style='width: 150px; height: auto;'><br>";
        }
    } else {
        echo "Nenhuma pizza selecionada.<br>";
    }

    echo "<h3>Bebida</h3>";
    if ($bebida) {
        echo "<img src='imagens/{$bebida}.png' alt='{$bebida}' style='width: 150px; height: auto;'><br>";
    } else {
        echo "Nenhuma bebida selecionada.<br>";
    }

    echo "<h3>Sobremesa</h3>";
    if ($sobremesa) {
        echo "<img src='imagens/{$sobremesa}.png' alt='{$sobremesa}' style='width: 150px; height: auto;'><br>";
    } else {
        echo "Nenhuma sobremesa selecionada.<br>";
    }
} else {
    echo "Erro ao realizar o pedido: " . $conexao->error;
}

$stmt->close();
$conexao->close();
?>
