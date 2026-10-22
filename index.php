<?php
require __DIR__ . '/config.php';
require_login();

$tutores = (int) db()
    ->query('SELECT COUNT(*) FROM tutores')
    ->fetchColumn();

$pets = (int) db()
    ->query('SELECT COUNT(*) FROM pets')
    ->fetchColumn();

$agendamentos = (int) db()
    ->query('SELECT COUNT(*) FROM agendamentos')
    ->fetchColumn();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel | VetCare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="topbar">
        <a class="brand" href="index.php">🐾 VetCare</a>
        <span>
            Olá, <?= e($_SESSION['user_name'] ?? 'Usuário') ?>!
            <a href="logout.php">Sair</a>
        </span>
    </header>

    <main class="container">
        <p class="eyebrow">PAINEL PRINCIPAL</p>
        <h1>Resumo da clínica</h1>

        <section class="stats">
            <article>
                <span>Tutores</span>
                <strong><?= $tutores ?></strong>
                <a href="tutores.php">Gerenciar tutores</a>
            </article>

            <article>
                <span>Pets</span>
                <strong><?= $pets ?></strong>
                <a href="pets.php">Gerenciar pets</a>
            </article>

            <article>
                <span>Agendamentos</span>
                <strong><?= $agendamentos ?></strong>
                <a href="agendamentos.php">
                    Gerenciar consultas
                </a>
            </article>
        </section>

        <h2>Funcionalidades</h2>

        <nav class="nav-cards">
            <a href="tutores.php">👥 Tutores</a>
            <a href="pets.php">🐶 Pets</a>
            <a href="agendamentos.php">📅 Agendamentos</a>
        </nav>
    </main>
</body>
</html>
