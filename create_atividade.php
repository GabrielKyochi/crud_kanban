<?php
session_start();
include '../crud_kanban/conexao/conexao.php';














?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar atividade</title>
</head>
<body>
    <header></header>
    <main>
        <form action="" method="POST">
        <label for="descricao"></label>
        <input type="text" name="descricao" placeholder="Descrição" required>

        <label for="nome_setor"></label>
        <input type="text" name="nome_setor" placeholder="Nome do setor" required>

        <label for="prioridade"></label>
        <select name="prioridade" id="proridade" required>
             <option value=""></option>
        </select>
        
        <label for=""></label>
        <input type="text">

        <label for=""></label>
        <input type="text">


        </form>
    </main>
    <footer></footer>
    
</body>
</html>