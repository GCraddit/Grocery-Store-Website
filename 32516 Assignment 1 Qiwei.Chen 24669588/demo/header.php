<header class="site-header">
    <a href="index.php">
    <img src="img/logo.png" alt="website Logo" class="logo-img">
    </a>

    <h1>GCStore</h1>

    <form action="search.php" method="get" class="search-form">
        <input type="text" name="q" placeholder="Search Porduct..." class="search-box">
        <button type="submit" class="serch-button">Search</button>
    </form>

    <nav class="top-nav">
        <ul class="top-menu">
            <li><a href="about.php">About</a></li>
            <li class="dropdown">
            <a href="#">Help</a>
            <ul class="submenu">
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            </li>
            <li><a href="#" class="btn sign-in">Sign In</a></li>
            <li><a href="#" class="btn sign-up">Sign Up</a></li>
        </ul>
    </nav>

    
    <div class="cart-float">
        <button class="cart-toggle">🛒Cart</button>

    </div>

    <div id="cart-preview" class="cart-preview">
        <p><a href="cart.php">Go to Cart</a></p>
    </div>

</header>
<script src="js/cart-preview.js"></script>

