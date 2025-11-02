<?php
session_start();
include("../crud_kanban/conexao/conexao.php");

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = $_POST["nome"] ?? "";
        $email = $_POST["email"] ?? "";

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
                echo "<a href='index.php'><button>Voltar para a página principal do Kanban</button></a>";
                exit;
            } else{
                echo "Erro ao cadastrar usuário.";
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
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <header>

    </header>

    <main>
        <form id="cadastro" method="POST" action="">
            <label for="nome"></label>
            <input type="text" name="nome" placeholder="Nome" required>

            <label for="email"></label>
            <input type="email" name="email" placeholder="E-mail" required>
            
            <button type="submit">Adicionar usuário</button>
            
        </form>
    </main>

    <footer>
    <a href="../crud_kanban/index.php"><button type="submit">Voltar para a página principal do kanban</button></a>
    </footer>
</body>
</html>