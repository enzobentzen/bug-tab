<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../classes/BugRepository.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    die("Invalid ID");
}

$repository = New BugRepository($pdo);

$bug = $repository->findByID($id);

if (!$bug) {
    die("Bug do not exist");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Edit Bug</title>
</head>

<body>

    <h1>Edit Bug</h1>

    <form action="update.php" method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= $bug['id'] ?>"
        >

        <label>Title</label>
        <input
            type="text"
            name="title"
            value="<?= htmlspecialchars($bug['title']) ?>"
        >

        <br><br>

        <label>Description</label>
        <textarea name="description"><?= htmlspecialchars($bug['description']) ?></textarea>

        <br><br>

        <label>Language</label>
        <input
            type="text"
            name="language"
            value="<?= htmlspecialchars($bug['language']) ?>"
        >

        <br><br>

        <label>Category</label>
        <input
            type="text"
            name="category"
            value="<?= htmlspecialchars($bug['category']) ?>"
        >

        <br><br>

        <label>Difficulty</label>

        <select name="difficulty">

            <option value="easy"
                <?= $bug['difficulty'] === 'easy' ? 'selected' : '' ?>>
                Fácil
            </option>

            <option value="medium"
                <?= $bug['difficulty'] === 'medium' ? 'selected' : '' ?>>
                Médio
            </option>

            <option value="hard"
                <?= $bug['difficulty'] === 'hard' ? 'selected' : '' ?>>
                Difícil
            </option>

        </select>

        <br><br>

        <label>Cause</label>
        <textarea name="cause"><?= htmlspecialchars($bug['cause']) ?></textarea>

        <br><br>

        <label>Solution</label>
        <textarea name="solution"><?= htmlspecialchars($bug['solution']) ?></textarea>

        <br><br>

        <label>What I learned</label>
        <textarea name="lesson"><?= htmlspecialchars($bug['lesson']) ?></textarea>

        <br><br>

        <button type="submit">
            Save changes
        </button>

    </form>

</body>

</html>