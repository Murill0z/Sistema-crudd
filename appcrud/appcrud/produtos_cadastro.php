<?php
include 'produtos_controller.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Pega todos os produtos para preencher os dados da tabela
$produtos = getProdutos();

// Variável que guarda o ID do produto que será editado
$produtoToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
// e se há um ID para edição do produto
if (isset($_GET['edit'])) {
    $produtoToEdit = getProduto($_GET['edit']);
}
?>

<?php include 'produtos.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Produtos</title>

    <!-- Link para o Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <script>
        function clearForm() {
            document.getElementById('nome').value = '';
            document.getElementById('descricao').value = '';
            document.getElementById('preco').value = '';
            document.getElementById('quantidade').value = '';
            document.getElementById('id').value = '';
        }
    </script>
</head>
<body>
    <div class="container mt-5">

        <!-- Título da Página -->
        <h2 class="mb-4">Cadastro de Produtos</h2>

        <!-- Formulário de Cadastro de Produtos -->
        <form method="POST" action="" class="mb-5">
            <input type="hidden" id="id" name="id" value="<?php echo $produtoToEdit['id'] ?? ''; ?>">

            <!-- Nome -->
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Produto:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $produtoToEdit['nome'] ?? ''; ?>" required>
            </div>

            <!-- Descrição -->
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control" required><?php echo $produtoToEdit['descricao'] ?? ''; ?></textarea>
            </div>

            <!-- Preço -->
            <div class="mb-3">
                <label for="preco" class="form-label">Preço:</label>
                <input type="number" id="preco" name="preco" class="form-control" value="<?php echo $produtoToEdit['preco'] ?? ''; ?>" required step="0.01">
            </div>

            <!-- Quantidade -->
            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" class="form-control" value="<?php echo $produtoToEdit['quantidade'] ?? ''; ?>" required>
            </div>

            <!-- Botões -->
            <div class="d-flex justify-content-between">
                <button type="submit" name="save" class="btn btn-primary">Salvar</button>
                <button type="submit" name="update" class="btn btn-warning">Atualizar</button>
                <button type="button" onclick="clearForm()" class="btn btn-secondary">Novo</button>
            </div>
        </form>

        <!-- Tabela de Produtos -->
        <h2 class="mb-4">Produtos Cadastrados</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Faz um loop para preencher a tabela com os produtos -->
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo $produto['nome']; ?></td>
                        <td><?php echo $produto['descricao']; ?></td>
                        <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $produto['quantidade']; ?></td>
                        <td>
                            <a href="?edit=<?php echo $produto['id']; ?>" class="btn btn-info btn-sm">Editar</a>
                            <a href="?delete=<?php echo $produto['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <!-- Link para os arquivos JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>

<?php include 'footer.php'; ?>
