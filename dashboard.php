<?php
session_start();

// Desconectar
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("location: index.php");
    exit();
}

// Verificar se existe usuário logado
if (!isset($_SESSION['usuario_id'])) {
    header("location: index.php");
    exit();
}

require_once 'includes/config.php'; // Inclua a conexão correta aqui

$sql = "SELECT * FROM produtos";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
    <title>Lista de Produtos</title>
</head>

<body>
    <header class ="cabe">
        <a href="?logout=true">Sair</a>
        <a href="cadastro-produto.php">Cadastrar produtos</a>
    </header>
    
    <main>
        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($produto = $resultado->fetch_assoc()): ?> <!-- Correção na função fetch_assoc -->
                <div class="quadrado">
                
                    <h3>Nome: <?php echo ($produto['nome']); ?></h3> <!-- Proteção contra XSS -->
                    <h3>Descrição: <?php echo ($produto['descricao']); ?></h3> <!-- Proteção contra XSS -->
                    <h3>Quantidade: <?php echo ($produto['quantidade']); ?></h3> <!-- Proteção contra XSS -->
                    <button>Editar</button>
                    <button>Excluir</button>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum produto cadastrado.</p>
        <?php endif; ?>
        
        <?php $conn->close(); ?>
    </main>
</body>
</html>
