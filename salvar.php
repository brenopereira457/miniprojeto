<?php
// Salvar.php - Recebe os dados via method=POST do formulario e grava a venda no Banco de Dados

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?msg=Metodo+Invalido');
    exit;
}

require_once 'conexcao.php';

$produto = isset($_POST['produto']) ? trim($_POST['produto']) :'';
$valor_unitario = isset ($_POST['valor_unitario']) ? str_replace(',','.', $_POST['valor_unitario']) : '';
$quantidade = isset($_POST['quantidade']) ? (int) $_POST['quantidade'] : 0;
$data_venda = isset($_POST['data_venda']) ? $_POST['data_venda'] : '';

if ($produto === '' || $valor_unitario === '' || $quantidade <= 0 || $data_venda === ''){
    header('Location: index.php?msg=Preencha+todos+os+campos+corretamente.');
    exit;
}

$valor_unitario = (float) $valor_unitario;
if ($valor_unitario < 0) {
    header('Location: index.php?msg=Valor+unitário+não+pode+ser+negativo.');
    exit;
}

// INSERT com prepared statement
$sql= "INSERT INTO vendas(produto, valor_unitario, quantidade, data_venda)
        VALUES (?, ?, ?, ?)";

$stmt=$conn->prepare($sql);
if (!$stmt) {
    header('Location: index.php?msg=Erro+ao+preparar+comando:+'.urlencode($conn ->error));
    exit;
}

$stmt->bind_param("sdis", $produto, $valor_unitario, $quantidade, $data_venda);

if ($stmt->execute()) {
    header('Location: index.php?msg=Venda+registrada+com+sucesso!');
} else {
    header('Location: index.php?msg=Erro+ao+registrar+a+venda:+' .urlencode($stmt->error));
}

$stmt->close();
$conn->close();
exit;