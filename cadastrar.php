<?php
require_once __DIR__ . '/conexao.php';

// Só aceita envio pelo formulário
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Recebe e limpa os dados
$nome           = trim($_POST['campo_nome'] ?? '');
$email          = trim($_POST['campo_email'] ?? '');
$senha          = $_POST['campo_senha'] ?? '';
$cpf            = preg_replace('/\D/', '', $_POST['campo_cpf'] ?? ''); // só números
$dataNascimento = $_POST['campo_data'] ?? '';

// Valida
$erros = [];

if ($nome === '') {
    $erros[] = 'Informe o nome.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = 'E-mail inválido.';
}
if (strlen($senha) < 6) {
    $erros[] = 'A senha deve ter pelo menos 6 caracteres.';
}
if (strlen($cpf) !== 11) {
    $erros[] = 'O CPF deve ter 11 dígitos.';
}
$data = DateTime::createFromFormat('Y-m-d', $dataNascimento);
if (!$data || $data->format('Y-m-d') !== $dataNascimento || $data > new DateTime()) {
    $erros[] = 'Data de nascimento inválida.';
}

if ($erros) {
    foreach ($erros as $erro) {
        echo htmlspecialchars($erro) . '<br>';
    }
    echo '<a href="index.php">Voltar</a>';
    exit;
}
$erro = '';
$cadastro = [
    'Nome' => $nome,
    'E-mail' => $email,
    'Senha' => $senha,
    'CPF' => $cpf,
    'Data de nascimento' => $dataNascimento,];

foreach ($cadastro as $campo => $valor) {
    if ($valor === '') {
        $erro = "O campo $campo é obrigatório";
        break;                       // achou um vazio: não precisa olhar o resto
    }
}                                    // ← o loop terminou: agora sim dá para concluir

if ($erro) {
    echo htmlspecialchars($erro) . ' <a href="index.php">Voltar</a>';
    exit;                            // tem campo vazio: para aqui
}


// Grava no banco
$sql = 'INSERT INTO usuarios (campo_nome, campo_senha, campo_email, campo_cpf, data_nascimento)
        VALUES (:nome, :senha, :email, :cpf, :data)';
try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome'  => $nome,
        ':senha' => password_hash($senha, PASSWORD_DEFAULT),
        ':email' => $email,
        ':cpf'   => $cpf,
        ':data'  => $dataNascimento,
    ]);

    $idUsuario = $pdo->lastInsertId();

    $stmt = $pdo->prepare('INSERT INTO tb_sessoes (id_usuario) VALUES (:id)');
    $stmt->execute([':id' => $idUsuario]);

    $pdo->commit();
    header('Location: form_cad.php');
    exit;
 
} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    if ($e->errorInfo[1] == 1062) {
        echo 'E-mail ou CPF já cadastrado. <a href="index.php">Voltar</a>';
    } else {
    error_log($e->getMessage());
    echo 'Erro ao cadastrar: ' . $e->getMessage();
}
};




 
    