<?php
session_start();
include '../crud_kanban/conexao/conexao.php';

if($_SERVER["REQUEST_METHOD"] === "POST") {
        $descricao = $_POST["descricao"] ?? "";
        $nome_setor = $_POST["nome_setor"] ?? "";
        $prioridade = $_POST["prioridade"] ?? "";
        $data_cadastro = $_POST["data_cadastro"] ?? "";
        $status = $_POST["status"] ?? "";
 
        $sql = "SELECT * FROM tarefas WHERE descricao = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $descricao);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            echo "Essa tarefa já está cadastrada.";
        } else{
            $sql = "INSERT INTO tarefas (descricao, nome_setor, prioridade, data_cadastro, status) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $descricao, $nome_setor, $prioridade, $data_cadastro, $status);
            if($stmt->execute()){
                echo "atividade cadastrada com sucesso!";
                echo "<a href='index.php'><button>Voltar para a página principal do Kanban</button></a>";
                exit;
            } else{
                echo "Erro ao cadastrar tarefa.";
                exit;
            }
        }

}












?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar atividade</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header></header>
    <main>
        <form id="formulario" action="" method="POST">
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
        </select>

        <button type="submit">Adicionar tarefa</button>
        </form>
    </main>
    <footer><a href="../crud_kanban/index.php"><button type="submit">Voltar para a página principal do kanban</button></a></footer>
    
</body>
</html>