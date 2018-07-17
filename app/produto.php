<?php include "../inicia.php"; ?>

<?php
$codigo = null;
$nome = null;
$descricao = null;
$quantidade = null;
$preco = null;
if (isset($_GET['codigo'])) {
    $codigo = intval($_GET['codigo']);
    $c = conecta();
    $query = 'SELECT nome, descricao, quantidade, preco FROM produto WHERE codigo = ?';
    $com = $c->prepare($query);
    $com->bind_param('i', $_GET['codigo']);
    $com->execute();
    $r = $com->get_result();
    $produto = $r->fetch_assoc();
    if (!$produto) {
        header('Location: produtos.php');
    }
    $nome = $produto['nome'];
    $descricao = $produto['descricao'];
    $quantidade = $produto['quantidade'];
    $preco = $produto['preco'];
}
if (isset($_SESSION['produto']) && isset($_GET['p'])) {
    $nome = $_SESSION['produto']['nome'];
    $descricao = $_SESSION['produto']['descricao'];
    $quantidade = $_SESSION['produto']['quantidade'];
    $preco = $_SESSION['produto']['preco'];
}
?>
<!doctype html>
<html>
<?php include RAIZ . "/core/templates/header.php"; ?>
<body>
<style>

    label {
        width: 100px;
    }

    input[type=text], textarea {
        width: 400px;
    }

    textarea {
        height: 100px;
    }

    #quantidade, #preco {
        text-align: right;
    }

</style>
<?php include RAIZ . "/core/templates/menu.php"; ?>
<main>
    <h1><a href="produtos.php">Produtos</a> / Produto</h1>

    <?php erro() ?>

    <form action="salva.php" method="post">
        <input type="hidden" name="codigo" value="<?= $codigo ?>">
        <div class="campo">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" value="<?= $nome ?>">
        </div>
        <div class="campo">
            <label for="descricao">Descrição: </label>
            <textarea name="descricao" id="descricao"><?= $descricao ?></textarea>
        </div>
        <div class="campo">
            <label for="descricao">Quantidade: </label>
            <input type="text" name="quantidade" id="quantidade" value="<?= $quantidade ?>">
        </div>
        <div class="campo">
            <label for="descricao">Preço: </label>
            <input type="text" name="preco" id="preco" value="<?= $preco ?>">
        </div>
        <input type="submit" value="Salvar">
        <input type="button" value="Voltar" onclick="produtos()">
    </form>
</main>
<script src="produto.js"></script>
</body>
</html>