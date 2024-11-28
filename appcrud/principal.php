<?php 
include 'principal_controller.php'; 

// Pega todos os produtos para preencher os dados da tabela 
$produtos = getProdutos();
?>

<?php include 'header.php'; ?>

<div class="container">
    <div class="flex-grow-1">
        <h2>Bem vindo, <?php echo htmlspecialchars($nome); ?>!</h2>
        
    </div>
</div>
<div class="container p-2">
    <?php foreach ($produtos as $produto): ?>    
        <div class="card float-left" style="width: 22rem;">
            <img src="<?php echo $produto['url_img']; ?>" class="rounded mx-auto d-block" alt="Imagem do Produto" style="width: 100px;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $produto['nome']; ?></h5>
                <p class="card-text"><?php echo $produto['descricao']; ?></p>
                <p><strong>Preço:</strong> R$ <?php echo number_format($produto['valorunitario'], 2, ',', '.'); ?></p>
                <!-- Formulário para adicionar ao carrinho -->
                <form method="POST" action="principal.php">
                    <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
                    <button type="submit" name="adicionar_produto" class="btn btn-primary btn-block">Comprar</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>
