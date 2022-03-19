<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">

        <!-- BRAND -->
        <a href="products.php" class="navbar-brand">
            <h1 class="h4">MiniMart Catalog</h1>
        </a>

        <!-- BUTTON -->
        <button class="navbar-toggler" data-toggle="collapse" data-target="#main_menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- LINKS -->
        <div class="collapse navbar-collapse" id="main_menu">
            <!-- left list -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="addproduct.php" class="nav-link">Products</a>
                </li>
                <li class="nav-item">
                    <a href="sections.php" class="nav-link">Sections</a>
                </li>
            </ul>
            <!-- right list -->
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['full_name'])): ?>
                    <li class='nav-item'>
                        <a href='profile.php' class='nav-link fw-bold'><?= $_SESSION['full_name'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Log out</a>
                    </li>
                <?php else: ?>
                    <li class='nav-item'>
                        <a href='login.php' class='nav-link'>Log in</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

    </div>
</nav>