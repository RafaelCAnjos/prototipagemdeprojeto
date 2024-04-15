<?php
include_once("conexao.php");

$nomeProduto = filter_input(INPUT_POST, 'nomeProduto', FILTER_SANITIZE_STRING);
$descricaoProduto = filter_input(INPUT_POST, 'descricaoProduto', FILTER_SANITIZE_STRING);
$precoProduto = filter_input(INPUT_POST, 'precoProduto', FILTER_SANITIZE_STRING);
$quantidadeProduto = filter_input(INPUT_POST, 'quantidadeProduto', FILTER_SANITIZE_STRING);


$query = " INSERT INTO produto ( prod_nome, prod_descri, prod_preco, prod_quant ) VALUES ('$nomeProduto', '$descricaoProduto', '$precoProduto', '$quantidadeProduto' )";
try {
    echo "$nomeProduto $descricaoProduto $precoProduto";
    mysqli_query($conn, $query);
    header("Location: ../php/geren_estoque.php");
    exit;
} catch (mysqli_sql_exception $e) {
    echo "" . $e->getMessage() . "";
    //header("Location: html/cadastra-se.html");
    exit;
}
