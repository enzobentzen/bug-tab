<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__ . '/../config/database.php';

$stmt = $pdo->query("SELECT * FROM bugs");

$bugs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<html lang="pt-br">

<head> 
    <meta charset="UTF-8"
    <title>Bug Tab - Bugs</title>
</head>    

<body>

    <h1> Bug Tab </h1>

    <h2> Lista de Bugs </h2>

    <?php foreach ($bugs as $bug): ?>

         <article>

            <h3> Title:
                <?= htmlspecialchars($bug['title']) ?>
            </h3>

            <p>
                <strong>Description:</strong>
                <?= htmlspecialchars($bug['description']) ?>
            </p>

            <p>
                <strong>Linguagem:</strong>
                <?= htmlspecialchars($bug['language']) ?>
            </p>

            <p>
                <strong>Categoria:</strong>
                <?= htmlspecialchars($bug['category']) ?>
            </p>

            <p>
                <strong>Dificuldade:</strong>
                <?= htmlspecialchars($bug['difficulty']) ?>
            </p>

            <a href="show.php?id<?= $bug['id'] ?>">
                See details
            </a>

            <hr>

        </article>

    <?php endforeach; ?>

</body>

</html>
