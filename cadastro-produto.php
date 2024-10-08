<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("location: index.php");
    exit();
}

require_once 'includes/config.php';

$mensagem_sucesso = "";
$mensagem_erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];

    // Valida se a quantidade é um número
    if (!is_numeric($quantidade) || $quantidade < 0) {
        $mensagem_erro = "Quantidade inválida.";
    } else {
        $sql_verifica = "SELECT * FROM produtos WHERE nome = ?";
        $stmt_verifica = $conn->prepare($sql_verifica);
        $stmt_verifica->bind_param('s', $nome);
        $stmt_verifica->execute();
        $resultado = $stmt_verifica->get_result();

        if ($resultado->num_rows > 0) {
            $mensagem_erro = "Este produto já está cadastrado.";
        } else {
            $sql = "INSERT INTO produtos (nome, descricao, quantidade) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssi', $nome, $descricao, $quantidade);

            if ($stmt->execute()) {
                $_SESSION['mensagem_sucesso'] = "Cadastro realizado com sucesso";
                header("Location: cadastro-produto.php");
                exit();
            } else {
                $mensagem_erro = "Erro ao cadastrar: " . $stmt->error; // Usar $stmt->error
            }
            $stmt->close(); // Fechar o stmt após uso
        }
        $stmt_verifica->close(); // Fechar o stmt de verificação
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cadastro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <title>Cadastrar</title>
</head>
<body>
  <div class="tudo">
    <form action="" method="POST">
      <h2>CADASTRO DE PRODUTOS</h2>
      
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required><br>

      <label for="descricao">Descrição:</label>
      <input type="text" id="descricao" name="descricao" required><br>

      <label for="quantidade">Quantidade:</label>
      <input type="text" id="quantidade" name="quantidade" required><br>



      <?php if ($mensagem_sucesso): ?>
        <p><?php echo $mensagem_sucesso; ?></p>
      <?php endif; ?>
      <?php if ($mensagem_erro): ?>
        <p><?php echo $mensagem_erro; ?></p>
      <?php endif; ?>
      


      <input type="submit" value="Cadastrar">
      <a href="dashboard.php">Ir para Deshboard</a>
    </form>
  </div>
</body>
</html>

