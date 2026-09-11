<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../classes/UserRepository.php';

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

//receber os dados o formulario

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

//validacoes

if ($email === '') {
    $_SESSION['error'] = "Email is required";
    header('Location: login.php');
    exit;
}

if ($password === '') {
    $_SESSION['error'] = "Email is required";
    header('Location: login.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email";
    header('Location: login.php');
    exit;
}

try {

    $repository = new UserRepository($pdo);

    $user = $repository->findByEmail($email);

    if ($user === null) {
        $_SESSION['error'] = "Invalid email or password";
        header('Location: login.php');
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        $_SESSION['error'] = "Invalid email or password";
        header('Location: login.php');
        exit;
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];

    $_SESSION['success'] = "Login successful";

    header('Location: login.php');
    exit;

} catch (PDOException $e) {

    $_SESSION['error'] = "Something went wrong while loggin in";
    header('Location: login.php');
    exit;
}    