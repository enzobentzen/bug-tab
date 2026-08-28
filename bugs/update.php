```php
<?php

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../classes/BugRepository.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$language = trim($_POST['language'] ?? '');
$category = trim($_POST['category'] ?? '');
$difficulty = trim($_POST['difficulty'] ?? '');
$cause = trim($_POST['cause'] ?? '');
$solution = trim($_POST['solution'] ?? '');
$lesson = trim($_POST['lesson'] ?? '');

if ($id === false || $id === null) {
    die("Invalid ID");
}

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

if (strlen($title) < 3 || strlen($title) > 50) {
    die("The title must have between 3 and 50 characters.");
}

if (strlen($description) < 10 || strlen($description) > 250) {
    die("The description must have between 10 and 250 characters.");
}

$allowedDifficulties = ['easy', 'medium', 'hard'];

if (!in_array($difficulty, $allowedDifficulties)) {
    die("Invalid difficulty.");
}

try {

    $repository = new BugRepository($pdo);

    $bug = $repository->findById($id);

    if ($bug === null) {
        die("Bug not found");
    }

    $repository->update(
        $id,
        $title,
        $description,
        $language,
        $category,
        $difficulty,
        $cause,
        $solution,
        $lesson
    );

    $_SESSION['success'] = "Bug updated successfully.";

    header('Location: index.php');
    exit;

} catch (PDOException $e) {

    echo "Something went wrong while updating the bug.";
}
