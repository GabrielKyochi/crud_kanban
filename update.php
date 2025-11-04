<?php
include '../crud_kanban/conexao/conexao.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("O id inserido é inválido ou não foi informado");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $id = intval($_POST['id']);
    $descricao = $_POST['descricao'] ?? "";
    $nome_setor = $_POST['nome_setor'] ?? "";
    $prioridade = $_POST['prioridade'] ?? "";
    $data_cadastro = $_POST['data_cadastro'] ?? "";
    $status = $_POST['status'] ?? "";
    $id_usuario = intval($_POST['id_usuario'] ?? 0);

    $sql = "UPDATE tarefas SET descricao = ?, nome_setor = ?, prioridade = ?, data_cadastro = ?, status = ?, id_usuario = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erro no prepare: " . $conn->error);
    }

    $stmt->bind_param("sssssii", $descricao, $nome_setor, $prioridade, $data_cadastro, $status, $id_usuario, $id);

    if ($stmt->execute()) {
        echo "Tarefa atualizada com sucesso. <a href='index.php'>Voltar</a>";
        $stmt->close();
        $conn->close();
        exit;
    } else {
        echo "Erro ao atualizar: " . $stmt->error;
        $stmt->close();
        $conn->close();
        exit;
    }
}

$stmt = $conn->prepare("SELECT * FROM tarefas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    die("Tarefa não encontrada.");
}

$resultUsuarios = $conn->query("SELECT id, nome FROM usuarios");
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atualizar tarefas</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <form class="formulario" method="POST" action="update.php?id=<?php echo $row['id']; ?>">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <input type="text" name="descricao" placeholder="Descrição" required value="<?php echo htmlspecialchars($row['descricao']); ?>">

        <input type="text" name="nome_setor" placeholder="Nome do setor" required value="<?php echo htmlspecialchars($row['nome_setor']); ?>">

        <select name="prioridade" id="prioridade" required>
             <option value="baixa" <?php echo ($row['prioridade']=='baixa')? 'selected':''; ?>>Baixa</option>
             <option value="media" <?php echo ($row['prioridade']=='media')? 'selected':''; ?>>Média</option>
             <option value="alta" <?php echo ($row['prioridade']=='alta')? 'selected':''; ?>>Alta</option>
        </select>
        
        <input type="date" name="data_cadastro" required value="<?php echo htmlspecialchars($row['data_cadastro']); ?>">

        <select name="status" id="status" required>
            <option value="a fazer" <?php echo ($row['status']=='a fazer')? 'selected':''; ?>>A fazer</option>
            <option value="fazendo" <?php echo ($row['status']=='fazendo')? 'selected':''; ?>>Fazendo</option>
            <option value="pronto" <?php echo ($row['status']=='pronto')? 'selected':''; ?>>Pronto</option>
        </select>

        <select name="id_usuario" id="id_usuario">
            <?php
            if ($resultUsuarios) {
                while($u = $resultUsuarios->fetch_assoc()){
                    $uid = $u['id'];
                    $nome = htmlspecialchars($u['nome']);
                    $sel = ($uid == $row['id_usuario']) ? "selected" : "";
                    echo "<option value='{$uid}' {$sel}>{$nome}</option>";
                }
            }
            ?>
        </select>

        <button type="submit">Atualizar tarefa</button>
    </form>

    <a href="index.php"><button>Voltar para a página principal do Kanban.</button></a>
</body>
</html>