<?php

require_once __DIR__ . '/conexao.php';
session_start();

if (isset($_SESSION['usuario_id']))
    {
        header('Location: painel.php');
        exit;
    }

$erro = '';
$email = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $email = trim($_POST['campo_email'] ?? '') ;
    $senha = ($_POST['campo_senha'] ?? '');



$stmt = $pdo->prepare('SELECT id_usuario, campo_nome, campo_senha FROM usuarios WHERE campo_email = :email');
$stmt->execute(['email' => $email]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($senha, $usuario['campo_senha'])) {
    session_regenerate_id(true);
    $_SESSION['usuario_id']     = $usuario['id_usuario'];
    $_SESSION['usuario_nome']   = $usuario['campo_nome'];
    
    header('Location: painel.php');
    exit;
    
} else {
        $erro = 'Email ou Senha incorretos.';
    }


}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="max-width: 400px;">
        <h1 class="mt-5">Entrar</h1>

        <?php if ($erro): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <label class="form-label" for="email">E-Mail:</label>
            <input class="form-control" type="email" id="email" name="campo_email"
                   value="<?= htmlspecialchars($email) ?>" required>

            <label class="form-label" for="senha">Senha:</label>
            <input class="form-control" type="password" id="senha" name="campo_senha" required>

            <button class="btn btn-primary mt-3 w-100" type="submit">Entrar</button>
        </form>

        <p class="mt-3">Não tem conta? <a href="index.php">Cadastre-se</a></p>
    </div>
</body>
</html>


