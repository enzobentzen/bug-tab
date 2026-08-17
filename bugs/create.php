<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Bug - BugTab</title>
</head>

<body>

    <h1>Novo Bug</h1>

    <form action="store.php" method="POST">

        <label for="title">Título:</label>
        <input type="text" id="title" name="title">

        <br><br>

        <label for="description">Descrição:</label>
        <textarea id="description" name="description"></textarea>

        <br><br>

        <label for="language">Linguagem:</label>
        <input type="text" id="language" name="language">

        <br><br>

        <label for="category">Categoria:</label>
        <input type="text" id="category" name="category">

        <br><br>

        <label for="difficulty">Dificuldade:</label>

        <select id="difficulty" name="difficulty">
            <option value="easy">Fácil</option>
            <option value="medium">Médio</option>
            <option value="hard">Difícil</option>
        </select>

        <br><br>

        <label for="cause">Causa:</label>
        <textarea id="cause" name="cause"></textarea>

        <br><br>

        <label for="solution">Solução:</label>
        <textarea id="solution" name="solution"></textarea>

        <br><br>

        <label for="lesson">O que aprendi:</label>
        <textarea id="lesson" name="lesson"></textarea>

        <br><br>

        <button type="submit">Cadastrar Bug</button>

    </form>

</body>
</html>
