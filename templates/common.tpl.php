<?php function drawNavBar() { ?>
    <nav>
        <ul class="nav-bar">
                <li>
                    Women
                </li>
                <li>
                    Men
                </li>
                <li>
                    Kids
                </li>
                <li>
                    Sneakers
                </li>
                <li>
                    Shoes
                </li>
            </ul>
    </nav>
<?php } ?>

<?php function drawHeader(){ ?>
    <header>
        <form class="search-form">
            <input type="text" placeholder="Search for items" cols="30" rows="10"></input>
            <button>
                <img src="imgs/magnify.svg">
            </button>
        </form>
            <a>Login</a>
            <a>Register</a>
            <a href="Sell.php">Sell Now</a>
    </header>    
<?php } ?>