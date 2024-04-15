<?php
include_once("conexao.php");

$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);

$busca1 = "select * from usuario where usu_email = '$email' ";
$resultado1 = mysqli_query($conn, $busca1);

if(mysqli_num_rows($resultado1) != 0) {
    echo "<script> alert('Email já cadastrado, tente outro.'); window.location.href = '../cad_usuario.html'; </script>";
    exit;
}

if ($password != $confirmPassword) {
    echo "<script> alert('senhas incompativeis'); window.location.href = '../html/cadastra-se.html'; </script>";
    exit;
}
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$query = " INSERT INTO usuario2 ( usu_nome, usu_email, usu_senha ) VALUES ('$firstname', '$email', '$hashedPassword' )";
try {
    mysqli_query($conn, $query);
    header("Location: ../../index.html");
    exit;
} catch (mysqli_sql_exception $e) {
    echo "" . $e->getMessage() . "";
    //header("Location: html/cadastra-se.html");
    exit;
}

