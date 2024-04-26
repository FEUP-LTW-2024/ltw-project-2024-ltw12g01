<?php require_once('templates/common.tpl.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php drawHeader(true); ?>
    <main>
        <h2>Products</h2>
        <section id = "products">
              <article>
                <a href="/pages/product.php?id=10">User Test</a>
                <img src="https://picsum.photos/200?1">
                <a href="pages/product.php">Sneakers 1</a>
                <h3>Hugo Boss</h3>
                <h4>Price: 44.99$</h4>
              </article>
              <article>
                <a href=".php?id=10">User Test</a>
                <img src="https://picsum.photos/200?1">
                <a href=".php?id=1">Sneakers 2</a>
                <h3>Hugo Boss</h3>
                <h4>Price: 44.99$</h4>
              </article>
              <article>
                <a href=".php?id=10">User Test</a>
                <img src="https://picsum.photos/200?1">
                <a href="user.php?id=2">Sneakers 3</a>
                <h3>Hugo Bossss</h3>
                <h4>Price: 44.99$</h4>
              </article>
              <article>
                <a href=".php?id=10">User Test</a>
                <img src="https://picsum.photos/200?1">
                <a href=".php?id=1">Sneakers 3</a>
                <h3>Hugo Boss</h3>
                <h4>Price: 44.99$</h4>
              </article>
              <article>
                <a href=".php?id=10">User Test</a>
                <img src="https://picsum.photos/200?1">
                <a href=".php?id=1">Sneakers 3</a>
                <h3>Hugo Boss</h3>
                <h4>Price: 44.99$</h4>
              </article>
              <article>
              <a href=".php?id=10">User Test</a>
                <img src="https://picsum.photos/200?1">
                <a href=".php?id=1">Sneakers 3</a>
                <h3>Hugo Boss</h3>
                <h4>Price: 44.99$</h4>
              </article>
              <article>
              <a href=".php?id=10">User Test</a>
                <img src="https://picsum.photos/200?1">
                <a href=".php?id=1">Sneakers 3</a>
                <h3>Hugo Boss</h3>
                <h4>Price: 44.99$</h4>
              </article>
              <article>
              <a href=".php?id=10">User Test</a>
                <img src="https://picsum.photos/200?1">
                <a href=".php?id=1">Sneakers 3</a>
                <h3>Hugo Boss</h3>
                <h4>Price: 44.99$</h4>
              </article>
        </section>
    </main>
    <?php drawFooter();?>
</body>
</html>