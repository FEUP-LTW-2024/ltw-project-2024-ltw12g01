<?php require_once('../templates/common.tpl.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<?php drawHeader(false); ?>
<body>
    <header>
         <!-- First bar, logo search bar etc-->
        <form class="search-form">
            <input type="text" placeholder="Search for items" cols="30" rows="10"></input>
            <button>
                <img src="../imgs/magnify.svg">
            </button>
        </form>
            <a>Login</a>
            <a>Register</a>
            <a>Sell Now</a>
    </header>
    <main>
        <h1>Nike Air Zoom Pegasus</h1>
        <h2>Nike</h2>
        <section id="product" class="product-grid">
        <div class="product-image">
            <img id="product-img" src="https://picsum.photos/200/300" alt="Nike Air Zoom Pegasus">
        </div>
        <div class="product-info">
            <h2>Nike Air Zoom Pegasus 38</h2>
            <p>A Nike Air Zoom Pegasus 38 é uma sapatilha versátil e confortável, perfeita para corridas de longa distância e treinos diários. Ela apresenta uma entressola responsiva com unidade Zoom Air no calcanhar, proporcionando amortecimento eficaz e retorno de energia. O cabedal em mesh respirável oferece ventilação e suporte, enquanto a sola de borracha durável proporciona tração em uma variedade de superfícies.</p>
            <p><strong>Preço:</strong> $129.99</p>
            <p><strong>Tamanhos disponíveis:</strong> 36-45</p>
            <p><strong>Cores disponíveis:</strong> Preto, branco, azul marinho, vermelho</p>
            <p><strong>Vendido por User:</strong> <a href="#">TestUser123</a></p>
        </div>
    </section>

    </main>
    <?php drawFooter(); ?>
</body>
</html>
