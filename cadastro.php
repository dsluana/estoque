<?php


require_once 'includes/config.php';

$mensagem_sucesso = "";
$mensagem_erro = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);


  $sql_verifica = "SELECT * FROM usuarios WHERE email = ?";
  $stmt_verifica = $conn->prepare($sql_verifica);
  $stmt_verifica->bind_param('s', $email);
  $stmt_verifica->execute();
  $resultado = $stmt_verifica->get_result();


  if ($resultado->num_rows > 0) {
    $mensagem_erro = "Este email ja esta cadastrado.";
  } else {
    $sql = "INSERT INTO usuarios (nome, email, senha) Values (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $nome, $email, $senha);


   
   
   
   
  $stmt->close();
  $conn->close();
   
    if ($stmt->execute()) {
      $_SESSION['mensagem_sucesso'] = "Cadastro realizado com sucesso";
      header("Location: cadastro.php");
      exit();
    } else {
      $mensagem_erro = "Erro ao cadastrar" . $conn->error;
    }
  }
}


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

    <title>Document</title>
</head>


<body>
  <div class= "tudo">
    <form action="" method="POST">
      <img src="blob:https://web.whatsapp.com/adf13a2a-0a07-4324-abe2-bee878baeee5" alt="">
      <h2>Cadastrar</h2>
      
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required><br>

      <label for="email">Email:</label>
      <input type="text" id="email" name="email" required><br>

      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" required><br>


      
 
       <p>Já tem conta? <a href="index.php">Ir para Login</a></p>
 
     
    </form>
   
  </div>

  <div class="login">
<input type="submit" value="Login">
</div>

</body>


</html>