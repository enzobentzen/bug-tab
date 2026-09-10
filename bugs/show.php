<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../classes/BugRepository.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    die("Invalid ID");
}

$repository = new BugRepository($pdo);

$bug = $repository->findbyI($id);

if ($bug === null) {
    die("Bug not found");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>
        <?= htmlspecialchars($bug['title']) ?>
    </title>
</head>

<body>

    <h1>
        <?= htmlspecialchars($bug['title']) ?>
    </h1>

    <p>
        <strong>Description:</strong>
        <?= htmlspecialchars($bug['description']) ?>
    </p>

    <p>
        <strong>Language:</strong>
        <?= htmlspecialchars($bug['language']) ?>
    </p>

    <p>
        <strong>Category:</strong>
        <?= htmlspecialchars($bug['category']) ?>
    </p>

    <p>
        <strong>Difficulty:</strong>
        <?= htmlspecialchars($bug['difficulty']) ?>
    </p>

    <h2>Cause</h2>

    <p>
        <?= nl2br(htmlspecialchars($bug['cause'])) ?>
    </p>

    <h2>Solution</h2>

    <p>
        <?= nl2br(htmlspecialchars($bug['solution'])) ?>
    </p>

    <h2>What I learned</h2>

    <p>
        <?= nl2br(htmlspecialchars($bug['lesson'])) ?>
    </p>

    <a href="index.php">
        Back to bugs
    </a>

</body>

</html>