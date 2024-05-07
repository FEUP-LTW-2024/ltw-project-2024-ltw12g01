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
                        <a href="/pages/product.php?id=<?=$item->id?>"> <?=$item->itemName ?></a>
                        <a href="/pages/product.php?id=<?=$item->id?>"><img src="https://picsum.photos/200?1"></a>
                        <h3> <?=$item->itemBrand ?></h3>
                        <h4>Price: <?=$item->itemPrice ?> </h4>
            </article>
            <?php } ?>
        </section>
    </main>
<?php } ?>

<?php function drawItem(Item $item) { ?>
  <main>
        <h1><?php echo $item->itemName; ?></h1>
        <h2><?php echo $item->itemBrand; ?></h2>
        <section id="product" class="product-grid">
        <div class="product-image">
            <img id="product-img" src="https://picsum.photos/200/300" alt="<?php echo $item->itemName; ?>">
        </div>
        <div class="product-info">
            <h2><?php echo $item->itemName; ?></h2>
            <p><?php echo $item->itemDescription; ?></p>
            <p><strong>Preço:</strong> <?php echo $item->itemPrice; ?></p>
            <p><strong>Categoria:</strong> <?php echo $item->itemCategory; ?></p>
            <p><strong>Vendido por:</strong> <a href="#"> <?php echo $item->itemOwner; ?></a></p>
            <button id="add-to-cart" onclick="addToCart(<?=$item->id; ?>)">Add to Cart</button>
        </div>
    </section>

    </main>

<script>
    function addToCart(productId) {
    $.ajax({
        type: 'POST',
        url: '/actions/add-to-cart',
        data: JSON.stringify({ productId: productId }),
        contentType: 'application/json',
        success: function(data) {
            console.log(data);
        }
    });
}
</script>

<?php } ?>