<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');

$itemId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($itemId === 0) {
    die('Item ID not provided or invalid');
}

$db = getDatabaseConnection();

$item = Item::getItem($db, $itemId); 

if (!$item) {
    die('Item not found');
}

?>
<?php require_once('../templates/common.tpl.php'); ?>
<?php $session = new Session(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="../javascript/UploadImage.js" defer></script>
    <script src="../javascript/Category.js" defer></script>
</head>

<body>
    <?php drawHeader(false); ?>
    <main class="sell">
        <h1>Edit Item</h1>

        <div class="img-load">
            <div class="border">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="blueviolet" class="upload-icon" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383" />
                    <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z" />
                </svg>
                <p>Drag and Drop files here</p>
                <p>or</p>
                <button onclick="triggerFileInput()">
                    Upload Images
                </button>
                <input type="file" id="hiddenInput" accept=".png,.jpg,.jpeg" multiple>
            </div>
        </div>
        <br>
        <div class="description">
            <div class="title">
                <span>Title</span>
                <form action="../actions/action_edit_item.php" method="post">
                <div class="title-input">
                    <input class="input" type="text" name="ItemName" placeholder="Item Name" required>
                    <label for="title" class="label">Item Name</label>
                </div>
                <div class="brand-input">
                    <span>Brand</span>
                    <input class="input" type="text" name="ItemBrand" placeholder="Item Brand" required>
                    <label for="brand" class="label">Brand</label>
                </div>
                <div class="owner-input">
                    <input type="hidden" name="ItemOwner" value="<?php echo $session->getName(); ?>">
                </div>
                <div class="border-descri"></div>
                <div class="descricao">
                    <span>Description</span>
                    <div class="descri-input">
                    <textarea class="input" name="ItemDescription" placeholder="Item Description" required></textarea>
                    <label for="description" class="label">Description</label>
                    </div>
                </div>
                <div class="category-div">
                    <div class="category">
                    <span>Category</span>
                    <div class="choose-cat">
                        <select name="ItemCategory">
                            <option value="Kids">Kids</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    </div>
                </div>
                <div class="price">
                    <span>Price</span>
                    <div class="price-input">
                    <input class="input" type="text" name="ItemPrice" placeholder="€ 0,00" required>
                    <label for="title" class="label">Price</label>
                    </div>
                </div>
                <div class="condition">
                <span>Condition</span>
                <div class="choose-cond">
                    <select name="ItemCondition">
                        <option value="New with tags">New with tags</option>
                        <option value="New without tags">New without tags.</option>
                        <option value="Very good">Very good</option>
                        <option value="Good">Good</option>
                        <option value="Satisfactory">Satisfactory</option>
                        <option value="Bad">Bad</option>
                    </select>
                </div>
            </div>

            <div class="size">
            <span>Size</span>
            <div class="choose-size">
                <select name="ItemSize">
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                    <option value="45">45</option>
                    <option value="46">46</option>
                </select>
            </div>
        </div>
                <button class="load-btn">Save Item</button>
                </form>
                    </main>
                </body>

</html>