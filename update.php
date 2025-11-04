<?php

include '../crud_kanban/conexao/conexao.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $descricao = $_POST["descricao"] ?? "";
    $nome_setor = $_POST["nome_setor"] ?? "";
    $prioridade = $_POST["prioridade"] ?? "";
    $data_cadastro = $_POST["data_cadastro"] ?? "";
    $status = $_POST["status"] ?? "";

    $sql = "UPDATE tarefas SET descricao ='$descricao', nome_setor ='$nome_setor', prioridade = '$prioridade', data_cadastro = '$data_cadastro', status = '$status'  WHERE id=$id";

    if ($conn->query($sql) === true) {
        echo "Tarefa atualizado com sucesso.
        <a href='index.php'>Voltar para a página principal do Kanban.</a>
        ";
        exit;
    } else {
        echo "Erro ao tentar atualizar tarefa " . $sql . '<br>' . $conn->error;
    }
    $conn->close();
    exit(); 
}

$sql = "SELECT * FROM tarefas WHERE id=$id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();


?>


<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar tarefas</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <form class="formulario" method="POST" action="update.php?id=<?php echo $row['id'];?>">

        <label for="descricao"></label>
        <input type="text" name="descricao" placeholder="Descrição" required>

        <label for="nome_setor"></label>
        <input type="text" name="nome_setor" placeholder="Nome do setor" required>

        <label for="prioridade"></label>
        <select name="prioridade" id="proridade" required>
             <option value="baixa">Baixa</option>
             <option value="media">Média</option>
             <option value="alta">Alta</option>
        </select>
        
        <label for="data_cadastro"></label>
        <input type="date" name="data_cadastro" placeholder="Data de cadastro" required>

        <label for="status"></label>
         <select name="prioridade" id="proridade" required>
            <option value="a fazer">A fazer</option>
            <option value="fazendo">Fazendo</option>
            <option value="pronto">Pronto</option>
        </select>

        <button type="submit">Atualizar tarefa</button>

    </form>

    <a href="index.php">Voltar para a página principal do Kanban.</a>

</body>

</html>