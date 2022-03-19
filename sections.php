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

    require "connection.php";

    function createSection($title){

        //$conn->query($sql)carries out the query.
        $conn = connection();
        $sql = "INSERT INTO `sections` (`title`) VALUE ('$title')";

        //To check if the execution is successful or not, use if...else condition.
        if ($conn -> query($sql)){
            header('refresh:0');
            //“Refresh: ”header will refresh the page if the query is successful. 
            //The number after it is the delay in seconds. 
            //The current page will refresh right away / no delay.

        }
        else{
            die('Error adding new product section: ' . $conn -> error);
            //$conn->error returns the description of the last error
        }
    
    
    }
    if (isset($_POST['btn_add'])){
        $title = $_POST['title'];
        createSection($title);
    }

?>
<body>
    <?php include 'mainMenu.php' ?>
    <main class="container-fluid">
        <div class="w-50 border border-2 border-light p-1 m-auto mt-5">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h2 class="card-title h4 mb-0">
                        Add New Section
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    <label for="title" class="small">Title</label>
                    <input type="text" name="title" id="title" class="form-control mb-4" required autofocus>
                    <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                    <button class="btn btn-info px-5" type="Submit" name="btn_add">Add</button>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>