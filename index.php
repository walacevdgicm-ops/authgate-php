<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Meu APP</h1>
        <form  action="cadastrar.php" method="post">
            <label class="form-label" for="nome">Nome Completo:</label>
            <input class="form-control" type="text" id="nome" name="campo_nome" required>
            <label class="form-label" for="cpf">CPF</label>
            <input class="form-control" type="number" id="cpf" name="campo_cpf" required>
            <label class="form-label" for="email">E-Mail:</label>
            <input class="form-control" type="text" id="email" name="campo_email" required>
            <label class="form-label" for="senha">Senha:</label>
            <input class="form-control" type="text" id="senha" name="campo_senha" required>
            <label class="form-label" for="data">Data de Nascimento:</label>
            <input class="form-control" type="date" id="data" name="campo_data" required>




            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>