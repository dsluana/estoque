<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
  header("location: dashboard.php");
  exit();
}

require_once 'includes/config.php';

$mensagem_erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql_verifica = "SELECT * FROM usuarios WHERE email = ?";
    $stmt_verifica = $conn->prepare($sql_verifica);
    $stmt_verifica->bind_param('s', $email);
    $stmt_verifica->execute();
    $resultado = $stmt_verifica->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        header("Location: dashboard.php");
        exit();
    } else {
        $mensagem_erro = "Email ou senha incorretos.";
    }

    $stmt_verifica->close();
}

// Fechar a conexão apenas no final
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>

<div class="img">
    <img src="img/user.png" alt="">
</div>

<div class="tudo">
    <form action="" method="POST">
        <h2>Login</h2>
        
        <div> 
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br>
        </div>

        <?php if ($mensagem_erro): ?>
            <p><?php echo $mensagem_erro; ?></p>
        <?php endif; ?>

        <div>
            <p>Não tem conta? <a href="cadastro.php">Ir para Cadastro</a></p>
        </div>

        <div>
            <input type="submit" value="Login">
        </div>
    </form>
</div>

</body>
</html>
