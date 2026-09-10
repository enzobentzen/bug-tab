<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>

    <h1>Create account</h1>

<?php if (isset($_SESSION['error'])): ?>

    <p>
        <?= htmlspecialchars($_SESSION['error']) ?>
    </p>

    <?php unset($_SESSION['error']); ?>

<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>

    <p>
        <?= htmlspecialchars($_SESSION['success']) ?>
    </p>

    <?php unset($_SESSION['success']); ?>

<?php endif; ?>

<form action="store.php" method="POST">
    <form action="store.php" method="POST">

        <label>Name</label>
        <input type="text" name="name" required>

        <br><br>

        <label>Email</label>
        <input type="email" name="email" required>

        <br><br>

        <label>Password</label>
        <input type="password" name="password" required>

        <br><br>

        <label>Confirm password</label>
        <input type="password" name="password_confirmation" required>

        <br><br>

        <button type="submit">Create account</button>

    </form>

</body>
</html>