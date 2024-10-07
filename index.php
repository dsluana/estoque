<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <title>Document</title>
</head>

<body>

<div class="img">
<img src="img/user.png" alt="">
</div>


  <div class= "tudo">
    <form action="" method="POST">   
<h2>Login</h2>
      
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required><br>

      <label for="email">Email:</label>
      <input type="text" id="email" name="email" required><br>

      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" required><br>


      
 
       <p>Já tem conta? <a href="cadastro.php">Ir para Cadastro</a></p>
 
     
    </form>
   
  </div>

  <div class="login">
<input type="submit" value="Login">
</div>

</body>
   

</html>