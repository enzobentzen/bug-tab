<?php
error_reporting(E_ALL);
ini_set("display_errors", 0);

require_once __DIR__ . '/../config/database.php'; 

$title = trim($_POST['title']);
$description = trim($_POST['description']);
$language = trim($_POST['language']);
$category = trim($_POST['category']);
$difficulty = $_POST['difficulty'];
$cause = trim($_POST['cause']);
$solution = trim($_POST['solution']);
$lesson = trim($_POST['lesson']);

if ($title === "") {
    die("The title is mandatory.");
}

if ($description === "") {
    die("The description is mandatory.");
}

if ($language === "") {
    die("Language is mandatory.");
}

if ($category === "") {
    die("The category is mandatory.");
}

if ($cause === "") {
    die("The cause is mandatory.");
}

if ($solution === "") {
    die("The solution is mandatory.");
}

if ($lesson === "") {
    die("The lesson is mandatory.");
}

$stmt = $pdo->prepare(
    "INSERT INTO bugs 
    (title, description, language, category, difficulty, cause, solution, lesson) 
    VALUES 
    (:title, :description, :language, :category, :difficulty, :cause, :solution, :lesson)"
);

$stmt->execute([
    ':title' => $title,
    ':description' => $description,
    ':language' => $language,
    ':category' => $category,
    ':difficulty' => $difficulty,
    ':cause' => $cause,
    ':solution' => $solution,
    ':lesson' => $lesson
]);

echo "The bug has been logged.";