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
