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
            echo "<img src='{$pizza}.png' alt='{$pizza}' style='width: 150px; height: auto;'><br>";
        }
    } else {
        echo "Nenhuma pizza selecionada.<br>";
    }

    echo "<h3>Bebida</h3>";
    if ($bebida) {
        echo "<img src='{$bebida}.png' alt='{$bebida}' style='width: 150px; height: auto;'><br>";
    } else {
        echo "Nenhuma bebida selecionada.<br>";
    }

    echo "<h3>Sobremesa</h3>";
    if ($sobremesa) {
        echo "<img src='{$sobremesa}.png' alt='{$sobremesa}' style='width: 150px; height: auto;'><br>";
    } else {
        echo "Nenhuma sobremesa selecionada.<br>";
    }
} else {
    echo "Erro ao realizar o pedido: " . $conexao->error;
}

$stmt->close();
$conexao->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Faça seu pedido!</title>
    <link rel="stylesheet" href="produto.css">
</head>
<body>
    <h1>Faça seu Pedido!</h1>
    <form action="produto.php" method="post">
        <h2>Pizzas</h2>
        <div>
            <input type="checkbox" name="pizza[]" value="Margherita" id="pizza-margherita">
            <label for="pizza-margherita">
                <img src="margherita.png" alt="Margherita" style="width: 150px; height: auto;">
                Margherita
            </label>
        </div>
        <div>
            <input type="checkbox" name="pizza[]" value="Calabresa" id="pizza-calabresa">
            <label for="pizza-calabresa">
                <img src="calabresa.png" alt="Calabresa" style="width: 150px; height: auto;">
                Calabresa
            </label>
        </div>
        <div>
            <input type="checkbox" name="pizza[]" value="Quatro Queijos" id="pizza-quatro-queijos">
            <label for="pizza-quatro-queijos">
                <img src="quatro-queijos.png" alt="Quatro Queijos" style="width: 150px; height: auto;">
                Quatro Queijos
            </label>
        </div>
        <div>
            <input type="checkbox" name="pizza[]" value="Frango com Catupiry" id="pizza-frango-catupiry">
            <label for="pizza-frango-catupiry">
                <img src="catupiry.png" alt="Frango com Catupiry" style="width: 150px; height: auto;">
                Frango com Catupiry
            </label>
        </div>
        <div>
            <input type="checkbox" name="pizza[]" value="Portuguesa" id="pizza-portuguesa">
            <label for="pizza-portuguesa">
                <img src="portuguesa.png" alt="Portuguesa" style="width: 150px; height: auto;">
                Portuguesa
            </label>
        </div>
        <div>
            <input type="checkbox" name="pizza[]" value="Vegetariana" id="pizza-vegetariana">
            <label for="pizza-vegetariana">
                <img src="vegetariana.png" alt="Vegetariana" style="width: 150px; height: auto;">
                Vegetariana
            </label>
        </div>
        <h2>Bebidas</h2>
        <div>
            <input type="radio" name="bebida" value="Coca-Cola" id="bebida-coca">
            <label for="bebida-coca">
                <img src="coca.png" alt="Coca-Cola" style="width: 150px; height: auto;">
                Coca-Cola
            </label>
        </div>
        <div>
            <input type="radio" name="bebida" value="Suco de Laranja" id="bebida-suco">
            <label for="bebida-suco">
                <img src="suco.png" alt="Suco de Laranja" style="width: 150px; height: auto;">
                Suco de Laranja
            </label>
        </div>
        <div>
            <input type="radio" name="bebida" value="Água" id="bebida-agua">
            <label for="bebida-agua">
                <img src="agua.png" alt="Água" style="width: 150px; height: auto;">
                Água
            </label>
        </div>
        <div>
            <input type="radio" name="bebida" value="Guaraná" id="bebida-guarana">
            <label for="bebida-guarana">
                <img src="guarana.png" alt="Guaraná" style="width: 150px; height: auto;">
                Guaraná
            </label>
        </div>
        <div>
            <input type="radio" name="bebida" value="Sprite" id="bebida-sprite">
            <label for="bebida-sprite">
                <img src="sprite.png" alt="Sprite" style="width: 150px; height: auto;">
                Sprite
            </label>
        </div>
        <h2>Sobremesas</h2>
        <div>
            <select name="sobremesa">
                <option value="Brownie">
                    <img src="brownie.png" alt="Brownie" style="width: 100px; height: auto;"> Brownie
                </option>
                <option value="Sundae">
                    <img src="sundae.png" alt="Sundae" style="width: 100px; height: auto;"> Sundae
                </option>
                <option value="Tiramisu">
                    <img src="tiramisu.png" alt="Tiramisu" style="width: 100px; height: auto;"> Tiramisu
                </option>
                <option value="Cheesecake">
                    <img src="cheesecake.png" alt="Cheesecake" style="width: 100px; height: auto;"> Cheesecake
                </option>
                <option value="Mousse de Chocolate">
                    <img src="chocolate.png" alt="Mousse de Chocolate" style="width: 100px; height: auto;"> Mousse de Chocolate
                </option>
            </select>
        </div>

        <input type="submit" value="Fazer Pedido">
    </form>
</body>
</html>



