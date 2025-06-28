<header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a href="index.php" class="navbar-brand">
            <h3 class="px-5">
                <i class="fas fa-boxes"></i>
            </h3>
        </a>
        <button class="navbar-toggler"
            type="button"
                data-toggle="collapse"
                data-target = "#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="mr-auto"></div>
            <div class="navbar-nav">
                <a href="cart.php" class="nav-item nav-link active">
                    <h5 class="px-5 cart">
                        <i class="fa fa-shopping-cart"></i>
                        <?php
                        if (isset($_SESSION['cart'])){
                            $count = 0;
                            foreach($_SESSION['cart'] as $v){
                                $count += $v;
                            }
                            echo "<span id=\"cart_count\" class=\"text-light bg-danger rounded-0\">$count</span>";
                        }else{
                            echo "<span id=\"cart_count\" class=\"text-light bg-danger rounded-0\">0</span>";
                        }
                        ?>
                        
                    </h5>
                </a>
            </div>
        </div>

    </nav>
</header>






