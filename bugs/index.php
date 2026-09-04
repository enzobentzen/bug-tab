<?php

session_start();  //inicia/retoma a sessão, habilitando o uso de $_SESSION

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../classes/BugRepository.php';

$repository = New BugRepository($pdo);

$bugs = $repository->findAll();

if (isset($_SESSION['success'])) {  //verifica se existe a variável de sessão success
    echo $_SESSION['success']; //imprime o valor dessa variável na tela
    unset($_SESSION['success']); //apaga a variável da sessão, para não exibir de novo depois
}

?>

<html lang="pt-br">

<head> 
    <meta charset="UTF-8"
    <title>Bug Tab - Bugs</title>
</head>    

<body>

    <h1> Bug Tab </h1>

    <h2> Bug List </h2>

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

            <a href="show.php?id=<?= $bug['id'] ?>">
                See details
            </a>

            <a href="edit.php?id=<?= $bug['id'] ?>">
                Editar
            </a>

            <form action="delete.php" method="POST">

             <input
             type="hidden"
             name="id"
             value="<?= $bug['id'] ?>">
            

            <button type="submit">
              Delete
            </button>

            </form>
            <hr>

        </article>

    <?php endforeach; ?>

</body>

</html>
