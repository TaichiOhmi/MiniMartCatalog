<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Minimart</title>
</head>
<?php
    session_start();

    require 'connection.php';

    function getSections(){
        $conn = connection();
        $sql = "SELECT * FROM sections";

        if ($result = $conn -> query($sql)){
            return $result;
            //$result contains the result from the database based on the SQL. 
            //result には、SQL に基づいてデータベースから取得した結果を格納。
            //$result is an object that contains many variables and functions.
            //$resultはたくさんの変数や関数が含まれているオブジェクト。
        }
        else{
            die('Error retrieving sections: ' . $conn -> error);
            //exitis the same as die().Use ONclause to define how the two tables are related. In this case, we connected them using the color id. The color id of Avocado is 4 because, on the colors table, the id of green i
        }
    }

    function createProduct($title, $description, $price, $section_id){
        $conn = connection();
        $sql = "INSERT INTO products (`title`, `description`, `price`, `section_id`) VALUES ('$title', '$description', $price, $section_id)";

        if ($conn -> query($sql)){
            header("location: products.php");
            //“Location:” header redirects the browser to the specified file/location.
            //"Location: "ヘッダーは、指定されたファイル/場所にブラウザをリダイレクトする。
            exit();
        }
        else{
            die('Error adding new product: ' . $conn -> error);
        }
    }

    if (isset($_POST['btn_add'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $section_id = $_POST['section_id'];

        createProduct($title, $description, $price, $section_id);
    }

?>
<body>
    <?php include 'mainMenu.php' ?>
    <main class="container-fluid">
        <div class="card w-50 mx-auto my-5">
            <div class="card-header bg-success text-white">
                <h2 class="card-title h4 mb-0">Add New Section</h2>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    <label for="title" class="small">Title</label>
                    <input type="text" name="title" id="title" class="form-control mb-2" required autofocus>
    
                    <label for="description" class="small">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control mb-2" required></textarea>
    
                    <label for="price" class="small">Price</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
    
                    <label for="section_id" class="small">Section</label>
                    <select name="section_id" id="section_id" class="form-control mb-5" required>
                        <option value="" hidden>Select Section</option>
                        <?php
                            $result = getSections();
    
                            while($row = $result -> fetch_assoc()){
                                echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                                // $row に resultオブジェクト内の fetch_assoc() メソッドを使ってdb内のデータを代入するのを while loop で繰り返し、繰り返しごとに $row の value を出力。
                                //fetch_assoc() fetches the rows inside $result as an associative array. 
                                //fetch_assoc() は、$result 内の行を連想配列として取得する。
                                //$row is an associative array, containing the results of the SQL. 
                                //$row は SQL の結果を格納した連想配列
                            }
                        ?>
                    </select>
    
                    <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                    <button class="btn btn-success px-5" type="Submit" name="btn_add">Add</button>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>