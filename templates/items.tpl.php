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


<?php function drawItem(Item $item){ ?>
  <main>
        <h1><?= $item->itemName ?></h1>
        <h2><?= $item->itemBrand ?></h2>
        <section id="product" class="product-grid">
        <div class="product-image">
            <img id="product-img" src="https://picsum.photos/200/300" alt="Nike Air Zoom Pegasus">
        </div>
        <div class="product-info">
            <h2><?= $item->itemName ?></h2>
            <p>A Nike Air Zoom Pegasus 38 é uma sapatilha versátil e confortável, perfeita para corridas de longa distância e treinos diários. Ela apresenta uma entressola responsiva com unidade Zoom Air no calcanhar, proporcionando amortecimento eficaz e retorno de energia. O cabedal em mesh respirável oferece ventilação e suporte, enquanto a sola de borracha durável proporciona tração em uma variedade de superfícies.</p>
            <p><strong>Preço:</strong> <?= $item->itemPrice ?></p>
            <p><strong>Tamanhos disponíveis:</strong> 36-45</p>
            <p><strong>Cores disponíveis:</strong> Preto, branco, azul marinho, vermelho</p>
            <p><strong>Vendido por User:</strong> <a href="#"> <?= $item->itemOwner ?></a></p>
        </div>
    </section>

    </main>

<?php } ?>
