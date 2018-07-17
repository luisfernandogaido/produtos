<?php include "../inicia.php"; ?>

<?php
$c = conecta();
$r = $c->query('SELECT codigo, nome, quantidade FROM produto');
?>

<!doctype html>
<html>
<?php include RAIZ . "/core/templates/header.php"; ?>
<body>
<?php include RAIZ . "/core/templates/menu.php"; ?>
<main>
    <h1>Produtos</h1>
    <a href="produto.php">Adicionar</a>
    <table>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
        <?php while ($l = $r->fetch_assoc()): ?>
            <tr>
                <td><?= $l['nome'] ?></td>
                <td class="numero"><?= $l['quantidade'] ?></td>
                <td>
                    <a href="produto.php?codigo=<?= $l['codigo'] ?>">Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</main>
</body>
</html>