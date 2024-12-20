<?php
$title = 'Товары';
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/header.php';

/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/db.php';

$products = $pdo->query("SELECT
products.*,
SUM(receipt_of_goods.amount) AS amount
FROM products
LEFT JOIN receipt_of_goods ON products.id = receipt_of_goods.product_id
GROUP BY products.id")->fetchAll();
?>

    <div class="container mt-3">
        <h1 class="text-primary mb-3"><?= $title ?></h1>
        <a href="/receipt-of-goods" class="btn btn-outline-secondary mb-3">Поступления товаров</a>
        <a href="/products/create.php" class="btn btn-primary mb-3" id="add_product">Добавить товар</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Артикул</th>
                <th>Количество</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <th><?= $product['id'] ?></th>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['article'] ?></td>
                    <td><?= is_null($product['amount']) ? '0' : $product['amount'] ?></td>
                    <td><a href="/products/details.php?article=<?= $product['article'] ?>" class="btn btn-info">Подробнее</a></td>
                    <td>
                        <a href="/products/edit.php?id=<?= $product['id'] ?>" class="btn btn-primary" id="edit_product">Изменить</a>
                    </td>
                    <td>
                        <a href="/products/actions/delete.php?id=<?= $product['id'] ?>"
                           class="btn btn-danger" id="delete_product">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/layouts/footer.php';
?>