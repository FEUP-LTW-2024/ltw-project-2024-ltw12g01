<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../database/item.class.php')
?>

<?php function drawItems(array $items) { ?>
 <main>
        <section id="products">
        <?php foreach($items as $item) { ?> 
        <article>
                    <a href="/pages/product.php?id=<?=$item->id?>"> <?=$item->itemName ?></a>
                    <a href="/pages/product.php?id=<?=$item->id?>"><img src="https://picsum.photos/200?1"></a>                        <h3> <?=$item->itemBrand ?></h3>
                    <h4>Price: <?=$item->itemPrice ?>$</h4>
        </article>
        <?php } ?>
    </section>
</main>
<?php } ?>

<?php 
function drawItem(Item $item) { ?>
    <head>
        <link rel="stylesheet" href="../style/product.css">
    </head>
    <main>
        <h1><?php echo $item->itemName; ?></h1>
        <section id="product" class="product-grid">
            <div class="product-image">
                <img id="product-img" src="<?php echo $item->ItemImage; ?>" alt="<?php echo $item->itemName; ?>">
            </div>
            <div class="product-info">
                <div class="info-item" id="price"><strong>Price:</strong> <?php echo $item->itemPrice; ?>$</div>
                <div class="info-item" id="brand"><strong>Brand:</strong> <?php echo $item->itemBrand; ?></div>
                <div class="info-item" id="category"><strong>Category:</strong> <?php echo $item->itemCategory; ?></div>
                <div class="info-item" id="size"><strong>Size:</strong> <?php echo $item->itemSize; ?></div>
                <div class="info-item" id="condition"><strong>Condition:</strong> <?php echo $item->itemCondition; ?></div>
                <div class="info-item" id="sold-by"><strong>Sold by:</strong> <a href="#"> <?php echo $item->itemOwner; ?></a></div>
                <div class="description-box">
                    <p><strong>Description:</strong> <?php echo $item->itemDescription; ?></p>
                </div>
            </div>
            </div>
            <form id="add-to-cart-form" action="../actions/action_cart.php" method="POST">
                <input type="hidden" name="item_json" value='<?php echo json_encode($item); ?>'>
                <button id="add-to-cart-Button" type="submit"> <i class="fa-solid fa-cart-plus"></i> Add to Cart  </button>
            </form>
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