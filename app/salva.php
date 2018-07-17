<?php
include "../inicia.php";
try {
    $_SESSION['produto'] = [
        'nome' => $_POST['nome'],
        'descricao' => $_POST['descricao'],
        'quantidade' => $_POST['quantidade'],
        'preco' => $_POST['preco'],
    ];
    if (empty($_POST['nome'])) {
        header('Location: produto.php?erro=Nome obrigatório.&p=1');
        exit;
    }
    if (empty($_POST['descricao'])) {
        header('Location: produto.php?erro=Descrição obrigatória.&p');
        exit;
    }
    if (empty($_POST['quantidade'])) {
        header('Location: produto.php?erro=Quantidade obrigatória.&p');
        exit;
    }
    if (empty($_POST['preco'])) {
        header('Location: produto.php?erro=Preço obrigatório.&p');
        exit;
    }
    if (!is_numeric($_POST['quantidade'])) {
        header('Location: produto.php?erro=Quantidade deve ser número.&p');
        exit;
    }
    if (!is_numeric($_POST['preco'])) {
        header('Location: produto.php?erro=Preço deve ser número.&p');
        exit;
    }
    $quantidade = intval($_POST['quantidade']);
    $preco = floatval($_POST['preco']);
    $c = conecta();
    if ($_POST['codigo']) {
        $query = <<< SQL
          UPDATE produto SET
          nome = ?,
          descricao = ?,
          quantidade = ?,
          preco = ?,
          atualizacao = NOW()
          WHERE codigo = ?
SQL;
        $com = $c->prepare($query);
        $com->bind_param('ssidi', $_POST['nome'], $_POST['descricao'], $quantidade, $preco, $_POST['codigo']);
    } else {
        $query = <<< SQL
          INSERT INTO produto
          (nome, descricao, quantidade, preco, criacao, atualizacao)
          VALUES
          (?, ?, ?, ?, NOW(), NOW())
SQL;
        $com = $c->prepare($query);
        $com->bind_param('ssid', $_POST['nome'], $_POST['descricao'], $quantidade, $preco);
    }
    $com->execute();
    header('Location: produtos.php');
} catch (\Throwable $e) {
    header('Location: produto.php?erro=' . $e->getMessage() . '&p');
}