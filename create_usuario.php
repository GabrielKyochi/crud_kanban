<?php
session_start();
include("../crud_kanban/conexao/conexao.php");

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = $_POST["nome"] ?? "";
        $email = $_POST["email"] ?? "";
        
        if(empty($nome)) {
            echo "O nome é obrigatório.";
            exit;
        } elseif (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/", $nome)) {
            echo "O nome deve conter apenas letras e espaços";
        }

        if(empty($email)){
            echo "O email é obrigatório";
            exit;
        }

        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Formato de email inválido.";
        } elseif(!preg_match("/^[^@]+@[^@]+\.(com)$/i", $email)){
            echo "O email deve conter '@' e terminar com '.com'.";
        }

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            echo "Esse email já está cadastrado.";
        } else{
            $sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $nome, $email);
            if($stmt->execute()){
                echo "Usuário cadastrado com sucesso!";
                exit;
            } else{
                echo "Erro ao cadastrar usuario.";
                exit;
            }
        }
    }
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar usuario</title>
    <link rel="stylesheet" href="../crud_kanban/style/style.css">
</head>
<body>
    <header>

    </header>

    <main>
        <form id="cadastro" method="POST" action="">
            <label for="nome"></label>
            <input type="text" name="nome" placeholder="Nome">

            <label for="email"></label>
            <input type="email" name="email" placeholder="E-mail">
            
            <button type="submit">Adicionar usuário</button>
            
        </form>
    </main>

    <footer>
    <a href="../crud_kanban/index.php"><button type="submit">Voltar para a página principal do kanban</button></a>
    </footer>
</body>
</html>