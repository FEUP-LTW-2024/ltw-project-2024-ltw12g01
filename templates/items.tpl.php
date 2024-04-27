<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../database/item.class.php')
?>

<?php function drawItems(array $items) { ?>
 <main>
    <h2>Products</h2>
        <section id="products">
            <?php foreach($items as $item) { ?> 
            <article>
                        <a href="/pages/product.php?id=<?=$item->id?>"> <?php $item->itemName ?></a>
                        <img src="https://picsum.photos/200?1">
                        <a href="pages/product.php"> <?php $item->itemName ?></a>
                        <h3> <?php $item->itemBrand ?></h3>
                        <h4>Price: <?php $item->itemPrice ?> </h4>
            </article>
            <?php } ?>
        </section>
    </main>
<?php } ?>

<?php function drawItemsWithoutDataBase(){ ?>
    <main>
    <h2>Products</h2>
    <section id = "products">
          <article>
            <a href=".php?id=10">User Test</a>
            <img src="https://picsum.photos/200?1">
            <a href="product.php">Sneakers 1</a>
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
 <?php } ?>