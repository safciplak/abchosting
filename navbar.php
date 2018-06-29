<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $this->getWithBasePath('/product/index'); ?>">ABC HOSTING</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $this->getWithBasePath('/product/index'); ?>">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $this->getWithBasePath('/cart/index'); ?>">Cart(<span
                            id="cartItemCount"><?php echo isset($_SESSION['productId']) ? count($_SESSION['productId']) : 0; ?></span>)</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $this->getWithBasePath('/cart/index'); ?>">User Balance(<span
                                id="">$<?php echo getPrice($_SESSION['userBalance']); ?></span>)</a>
                </li>
            </ul>
        </div>
    </div>
</nav>