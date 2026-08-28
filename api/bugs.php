<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../classes/BugRepository.php';


header('Content-type: application/json');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    http_response_code(400);

    echo json_encode(['error' => 'Invalid ID']);
    exit;
}

try { 
    
    $repository = New BugRepository($pdo);

    $bug = $repository->findByID($id);

    if ($bug === null) {
        http_response_code(404);

        echo json_encode(['error' => 'Bug not found']);

     exit;
    }

} catch(PDOException $e) {

    http_response_code(500);

    echo json_encode(['error' => 'Internal server error']);
}