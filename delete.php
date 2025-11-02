<?php

include '../crud_kanban/conexao/conexao.php';
$id = $_GET['id'];

$sql = " DELETE FROM tarefas WHERE id=$id ";

if ($conn->query($sql) === true) {
    echo "Tarefa excluída com sucesso.
        <a href='index.php'><button>Voltar para a página principal do kanban.</button></a>
        ";
} else {
    echo "Erro " . $sql . '<br>' . $conn->error;
}
$conn -> close();
exit();