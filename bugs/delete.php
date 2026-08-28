<?php

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../class/BugRepository.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    die("Invalid ID");
}

$repository = New BugRepository($pdo);

$delete = $repository->delete($id);

if (!$delete === null) {
    $_SESSION['error'] = 'Bug not found.';
} else {
    $_SESSION['sucess'] = 'Bug deleted successfully.';
}

header('Location: index.php');
exit;