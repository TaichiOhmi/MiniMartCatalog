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
    require 'connection.php';

    function getProduct($id) {
        $conn = connection();
        // 入力から受け取ったidと同じidを持つ行を抽出する。Extract rows with the same id as the id received from the input
        $sql = "SELECT * FROM products WHERE id = $id";

        if ($result = $conn -> query($sql)){
            return $result -> fetch_assoc();
        }
        else{
            die("Error retrieving product: " . $conn -> error);
        }
    }

    //gets the id from the URL and which is sent to getProduct()function. 
    $id = $_GET['id'];
    //The $row is an associative array which will receive the value returned by getProduct()function
    $row = getProduct($id);

    function getSections(){
        $conn = connection();
        $sql = "SELECT * FROM sections";

        if ($result = $conn -> query($sql)){
            return $result;
        }
        else{
            die("Error retrieving product: " . $conn -> error);
        }
    }

    //backticks(`) are for the database identifiers (such as table name, column name), and single quotes (`) are for values.
    function updateProduct($id, $title, $description, $price, $section_id){
        $conn = connection();
        $sql = "UPDATE products SET `title` = '$title', `description` = '$description', `price` = '$price', `section_id` = '$section_id' WHERE id = $id";

        if ($conn -> query($sql)){
            header("location: products.php");
            exit;
        }
        else{
            die("Error updating product: " . $conn -> error);
        }
    }

    if (isset($_POST['btn_save'])){
        $id = $_GET['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $section_id = $_POST['section_id'];

        updateProduct($id, $title, $description, $price, $section_id);
    }

?>
<body>
<main class="card w-25 mx-auto my-5">
        <div class="card-header bg-secondary text-white">
            <h2 class="card-title h4 mb-0">Edit Product Details</h2>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <label for="title" class="small">Title</label>
                <input type="text" name="title" id="title" class="form-control mb-2" value="<?= $row['title'] ?>" required autofocus>

                <label for="description" class="small">Description</label>
                <textarea name="description" id="description" rows="4" class="form-control mb-2"  required><?= $row['description'] ?></textarea>

                <label for="price" class="small">Price</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" name="price" id="price" class="form-control" value="<?= $row['price'] ?>" required>
                </div>

                <label for="section_id" class="small">Section</label>
                <select name="section_id" id="section_id" class="form-control mb-5" required>
                    <option value="" hidden>Select Section</option>
                    <?php
                        $resultSection = getSections();
                        while($rowSection = $resultSection -> fetch_assoc()){
                            if ($rowSection['id'] == $row['section_id']){
                                echo "<option value='" . $rowSection['id'] . "' selected>" . $rowSection['title'] . "</option>";
                            }
                            else{
                                echo "<option value='" . $rowSection['id'] . "'>" . $rowSection['title'] . "</option>";
                            }
                            // $rowSection に resultSectionオブジェクト内の fetch_assoc() メソッドを使ってdb内のデータを代入するのを while loop で繰り返し、繰り返しごとに $rowSection の value を出力。
                        }
                    ?>
                </select>

                <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                <button class="btn btn-secondary px-4" type="submit" name="btn_save">Save</button>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>