<?php
// index.php - Formulário para Registrar uma nova venda

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Vendas</title>
</head>
    <body>
        <h1>Registro de vendas </h1>

        <nav>
            <a href="index.php">Registrar Vendas</a>
            <a href="vendas.php">Ver Vendas</a>
        </nav>

        <?php if (!empty($_GET['msg'])): ?>
            <div>
                <?php echo htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif;  ?>
    
        <form action="salvar.php" method="post">
            <label for="produto">Produto:</label>
            <input type="text" name="produto" id="produto" required>

            <label for="valor_unitario">Valor Unitário (R$):</label>
            <input type="number" name="valor_unitario" id="valor_unitario" step="0.01" min="0" required>
            <label for="quantidade">Quantidade:</label>
            <input type="number" name="quantidade" id="quantidade" min="1" step="1" required>
            <label for="data_venda">Data da Venda:</label>
            <input type="date" name="data_venda" id="data_venda" required>

            <button type="submit">Registrar Venda</button>
        </form>
    </body>
</html>