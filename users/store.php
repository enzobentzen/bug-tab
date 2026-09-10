<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../classes/UserRepository.php';

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

//receber os dados enviados no post, enviado pelo formulario
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');
$passwordConfirmation = trim($_POST['password_confirmation'] ?? '');

//Validacoes
if ($name === '') {
    $_SESSION['error'] = "Name is required.";
    header('Location: register.php');
    exit;
}

if ($email === '') {
    $_SESSION['error'] = "Email is required.";
    header('Location: register.php');
    ;   
}

if ($password === '') {
    $_SESSION['error'] = "Password is required.";
    header('Location: register.php');
    exit;
}

if ($passwordConfirmation === '') {
    $_SESSION['error'] = "PasswordConfirmation is required.";
    header('Location: register.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  //verifica se o email realmente tem formato de email
    $_SESSION['error'] = "Invalid email.";
    header('Location: register.php');
    exit;
}

if ($password !== $passwordConfirmation) { //verifica se as senhas sao iguais
    $_SESSION['error'] = "Passwords do not match.";
    header('Location: register.php');
    exit;
}

if (strlen($password) < 8) {
    $_SESSION['error'] = "Password must have at least 8 characters.";
    header('Location: register.php');
    exit;
}

//pega a senha que o usuario digitou e transforma em um hash seguro
$passwordHash = password_hash($password, PASSWORD_DEFAULT);


try {

    $repository = new UserRepository($pdo);

    $repository->create(
        $name,
        $email,
        $passwordHash
    );

    echo "Account created successfully";

} catch (PDOException $e) {
    echo "Something went wrong while creating account.";

}