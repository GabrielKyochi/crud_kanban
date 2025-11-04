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
        <?php
        $res = $conn->query("SELECT id, descricao, nome_setor, prioridade, status FROM tarefas ORDER BY id DESC");
        if ($res && $res->num_rows > 0) {
            while ($t = $res->fetch_assoc()) {
                $tid = (int)$t['id'];
                $desc = $t['descricao'];
                $setor = $t['nome_setor'];
                $prio = $t['prioridade'];
                $status = $t['status'];
                echo "<div class='grid'>";
                echo "<h3>{$desc}</h3>";
                echo "<div class='flex'><p>Setor: {$setor} Prioridade: {$prio} Status: {$status}</p> </div>";
                echo "<a href='update.php?id={$tid}'>Atualizar tarefa</a> ";
                echo "<a href='delete.php?id={$tid}' onclick=\"return confirm('Confirmar exclusão?')\">Deletar tarefa</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhuma tarefa encontrada.</p>";
        }
        ?>
    </main>
    <footer></footer>
</body>
</html>