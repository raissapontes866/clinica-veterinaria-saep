<?php
require __DIR__ . '/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    $stmt = db()->prepare(
        'SELECT id, nome, senha_hash, ativo
         FROM usuarios WHERE login = ? LIMIT 1'
    );

    $stmt->execute([$login]);
    $usuario = $stmt->fetch();

    if (
        $usuario &&
        (int) $usuario['ativo'] === 1 &&
        password_verify($senha, $usuario['senha_hash'])
    ) {
        session_regenerate_id(true);

        $_SESSION['user_id'] = (int) $usuario['id'];
        $_SESSION['user_name'] = $usuario['nome'];
        $_SESSION['last_activity'] = time();

        header('Location: index.php');
        exit;
    }

    $error = 'Login ou senha inválidos.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | VetCare</title>
    <link rel="stylesheet" href="style.css">
</head>
  <script src="script.js"></script>
<body class="login-page">
    <main class="login-card">
        <p class="eyebrow">VETCARE</p>
        <h1>Acessar o sistema</h1>

        <?php if ($error): ?>
            <p class="alert">
                <?= e($error) ?>
            </p>
        <?php endif; ?>

        <?php if (isset($_GET['expirou'])): ?>
            <p class="alert">
                Sua sessão expirou. Entre novamente.
            </p>
        <?php endif; ?>

        <form method="post" data-validar>
            <label>
                Usuário
                <input
                    type="text"
                    name="login"
                    autocomplete="username"
                    required
                >
            </label>

            <label>
                Senha
                <input
                    type="password"
                    name="senha"
                    autocomplete="current-password"
                    required
                >
            </label>

            <button type="submit">Entrar</button>
        </form>
    </main>

    <script src="script.js"></script>
</body>
</html>
