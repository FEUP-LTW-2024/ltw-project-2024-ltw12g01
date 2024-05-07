<?php 
require_once('../templates/common.tpl.php');
require_once('../actions/action_sell.php');
?>

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
   <form class="sell" action="your_action_url_here" method="post">
            <main>
            <h1>Sell an article</h1>

<<<<<<< HEAD
            <div class="img-load">
                <div class="border">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#0056B3" class="upload-icon" viewBox="0 0 16 16">
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
                    <div class="title-input">
                        <input class="input" type="text" placeholder="por exemplo:t-shirt preta da ZARA" required="">
                        <label for="title" class="label">Title</label>
                    </div>
=======
        <div class="img-load">
            <div class="border">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#0056B3" class="upload-icon" viewBox="0 0 16 16">
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
                <!-- <svg class="example-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                    <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z" />
                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg> -->
                <form action="../actions/action_sell.php" method="post">
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
                    <input type="hidden" name="ItemOwner" value="<?php echo $_SESSION['username']; ?>">
>>>>>>> bf635b51a774174b5b5e88081f992b98b86f4c84
                </div>
                <div class="border-descri"></div>
                <div class="descricao">
                    <span>Description</span>
                    <div class="descri-input">
<<<<<<< HEAD
                        <textarea class="input" placeholder="por exemplo: usado algumas vezes, comprado em 2023" name="Text1" cols="40" rows="3"></textarea>
                        <label for="description" class="label">Description</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="category-div">
                <div class="category">
                    <span>Category</span>
                    <div class="choose-cat">
                        <input readonly placeholder="Choose a category">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4" />
                        </svg>
                    </div>
                </div>
                <div class="border-descri"></div>
                <div class="price">
                    <span>Size</span>
                    <div class="price-input">
                        <input class="input" type="text" placeholder="€ 0,00" required="">
                        <label for="title" class="label">Price</label>
                    </div>
                </div>
            </div>
            <br>
            <button class="load-btn" type="submit">Post Product</button>
        </main>
</form>

</body>

=======
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
                <button class="load-btn">Save Item</button>
                </form>
                    </main>
                </body>
>>>>>>> bf635b51a774174b5b5e88081f992b98b86f4c84

</html>