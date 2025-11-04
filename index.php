<?php

include '../crud_kanban/conexao/conexao.php';


?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>
        <a href="create_usuario.php"><button>Ir para a tela de cadastrar usuários.</button></a>
        <a href="create_tarefa.php"><button>Ir para a tela de cadastrar atividades.</button></a>
    </header>
    <main class="flex">
        <div class="colunas_kanban">
            <h2>A fazer</h2>
            <?php
            $res = $conn->query("SELECT t.id, t.descricao, t.nome_setor, t.prioridade, t.data_cadastro, u.nome AS usuario_nome FROM tarefas t LEFT JOIN usuarios u ON t.id_usuario = u.id WHERE t.status = 'a fazer' ORDER BY t.id DESC");
            if ($res && $res->num_rows > 0) {
                while ($t = $res->fetch_assoc()) {
                    $tid = (int)$t['id'];
                    $desc = $t['descricao'];
                    $setor = $t['nome_setor'];
                    $prio = $t['prioridade'];
                    $data_cadastro = $t['data_cadastro'];
                    $user = $t['usuario_nome'] ?? 'Não atribuído';
                    echo "<div class='tarefas'>";
                    echo "<h3>{$desc}</h3>";
                    echo "<p>Setor: {$setor} <br> Prioridade: {$prio} <br> Usuário: {$user} <br> Data de criação: {$data_cadastro}</p>";
                    echo "<a href='update.php?id={$tid}'>Atualizar tarefa</a> ";
                    echo "<a href='delete.php?id={$tid}' onclick=\"return confirm('Confirmar exclusão?')\">Deletar tarefa</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhuma tarefa.</p>";
            }
            ?>
        </div>

        <div class="colunas_kanban">
            <h2>Fazendo</h2>
            <?php
            $res = $conn->query("SELECT t.id, t.descricao, t.nome_setor, t.prioridade, t.data_cadastro, u.nome AS usuario_nome FROM tarefas t LEFT JOIN usuarios u ON t.id_usuario = u.id WHERE t.status = 'fazendo' ORDER BY t.id DESC");
            if ($res && $res->num_rows > 0) {
                while ($t = $res->fetch_assoc()) {
                    $tid = (int)$t['id'];
                    $desc = $t['descricao'];
                    $setor = $t['nome_setor'];
                    $prio = $t['prioridade'];
                    $data_cadastro = $t['data_cadastro'];
                    $user = $t['usuario_nome'] ?? 'Não atribuído';
                    echo "<div class='tarefas'>";
                    echo "<h3>{$desc}</h3>";
                    echo "<p>Setor: {$setor} <br> Prioridade: {$prio} <br> Usuário: {$user} <br> Data de criação: {$data_cadastro} </p>";
                    echo "<a href='update.php?id={$tid}'>Atualizar tarefa</a> ";
                    echo "<a href='delete.php?id={$tid}' onclick=\"return confirm('Confirmar exclusão?')\">Deletar tarefa</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhuma tarefa.</p>";
            }
            ?>
        </div>

        <div class="colunas_kanban">
            <h2>Pronto</h2>
            <?php
            $res = $conn->query("SELECT t.id, t.descricao, t.nome_setor, t.prioridade, t.data_cadastro, u.nome AS usuario_nome FROM tarefas t LEFT JOIN usuarios u ON t.id_usuario = u.id WHERE t.status = 'pronto' ORDER BY t.id DESC");
            if ($res && $res->num_rows > 0) {
                while ($t = $res->fetch_assoc()) {
                    $tid = (int)$t['id'];
                    $desc = $t['descricao'];
                    $setor = $t['nome_setor'];
                    $prio = $t['prioridade'];
                    $data_cadastro = $t['data_cadastro'];
                    $user = $t['usuario_nome'] ?? 'Não atribuído';
                    echo "<div class='tarefas'>";
                    echo "<h3>{$desc}</h3>";
                    echo "<p>Setor: {$setor} <br> Prioridade: {$prio} <br> Usuário: {$user} <br> Data de criação: {$data_cadastro}</p>";
                    echo "<a href='update.php?id={$tid}'>Atualizar tarefa</a> ";
                    echo "<a href='delete.php?id={$tid}' onclick=\"return confirm('Confirmar exclusão?')\">Deletar tarefa</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhuma tarefa.</p>";
            }
            ?>
        </div>
    </main>
    <footer></footer>
</body>
</html>