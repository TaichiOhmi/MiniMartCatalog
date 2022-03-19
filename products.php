<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/edab1adf4f.js" crossorigin="anonymous"></script>
    <title>Minimart</title>
</head>
<?php
    session_start();

    require 'connection.php';

    function getProducts(){
        $conn = connection();
        $sql = "SELECT 
        products.id AS `id`, 
        products.title AS `title`, 
        products.description AS `description`, 
        products.price AS `price`, 
        sections.title AS `section`
        FROM products
        INNER JOIN sections
        ON products.section_id = sections.id
        ORDER BY products.id";

        if ($result = $conn -> query($sql)){
            return $result;
        }
        else{
            die('Error retrieving products: ' . $conn -> error);
        }
    }

    if (!isset($_SESSION['full_name'])){
        header("location: login.php");
            exit;
    }
?>
<body>
    <?php include 'mainMenu.php' ?>
    <main class="container-fluid py-5 w-75">
        <div class="d-flex">
            <h2 class="h3 text-muted m-0 flex-grow-1">Product List</h2>
            <a href="addProduct.php" class="btn btn-success"><i class="fas fa-plus-circle"></i> Add New Product</a>
            <a href="sections.php" class="btn btn-outline-info ms-2"><i class="fas fa-plus-circle"></i> Add New Section</a>
        </div>
        

        <div class="table-responsive">
            <table class="table table-hover mt-4">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>TITLE</th>
                        <th>DESCRIPTION</th>
                        <th>PRICE</th>
                        <th>SECTION</th>
                        <th style="width: 95px"></th><!-- for action buttons -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = getProducts();
                    while ($row = $result -> fetch_assoc()){
                    ?>
                        <tr>
                            <?php /* <?= ... ?>は<?php echo ... ?>の省略形 */ ?>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['description'] ?></td>
                            <td><?= '$' . $row['price'] ?></td>
                            <td><?= $row['section'] ?></td>
                            <td>
                                <a href="editProduct.php?id=<?= $row['id'] ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <!-- URLをPHPを用いて記述 -->
                                <a href="removeProduct.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>