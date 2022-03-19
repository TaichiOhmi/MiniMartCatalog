<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/edab1adf4f.js" crossorigin="anonymous"></script>
    <title>MiniMart</title>
</head>
<?php
    session_start();

    include 'connection.php';
    //require：致命的なエラー（Fatal）となり処理を停止
    //include：警告（Warning）となり処理は継続

    function updatePhoto($id, $image_name, $image_tmp){
        $conn = connection();
        $sql = "UPDATE users SET photo = '$image_name' WHERE id = $id";

        if ($conn -> query($sql)){
            $destination = 'img/' . basename($image_name);//basename() パスの最後にある名前の部分を返す
            if (move_uploaded_file($image_tmp, $destination)){//moves the photo from the temporary folder to the imgfolder which we created earlier.
                header('refresh: 0');
            }
            else{
                die('Error moving the photo.');
            }
        }
        else{
            die('Error uploading photo: ' . $conn -> error);
        }
    }

    function getUser($id){
        $conn = connection();
        $sql = "SELECT * FROM users WHERE id = $id";

        if ($result = $conn -> query($sql)){
            return $result -> fetch_assoc();
        }
        else{
            die('Error retrieving user: ' . $conn -> error);
        }
    }

    $row = getUser($_SESSION['user_id']);

    if (isset($_POST['btn_update_photo'])){
        $id = $_SESSION['user_id'];
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        
        updatePhoto($id, $image_name, $image_tmp);

        //$_FILES is a 2-dimensional array. The first array is the name of the <input>element. The second element is the property of the file.
        // PROPERTIES
        // [‘name’] -name of the file
        // [‘tmp_name’] -path of the file inside the temporary storage in your computer. The file is  placed on a temporary folder before moving it to the destination.
        // [‘size’] -size of the file in bytes
        // [‘error’] -the error code of the file. This is 0 if there is no err

    }

?>
<body>
    <?php include 'mainMenu.php'; ?>
    <main class="container py-5">
        <div class="card w-25 mx-auto">
            <?php
                echo "<img src='img/" . $row['photo'] . "' alt='" . $_SESSION['full_name'] . "' class='card-img-top'>";
            ?>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="input-group mb-2 col">
                        <input type="file" name="image" id="image" class="form-control" required>
                    </div>

                    <button class="btn btn-outline-secondary btn-sm btn-block w-100" type="submit" name="btn_update_photo">Update</button>
                </form>

                <div class="mt-5">
                    <p class="lead fw-bold mb-0">
                        <?= $row['username'] ?>
                        <!-- You can also use $_SESSION['username'] -->
                    </p>
                    <p class="lead">
                        <?= $row['first_name'] . ' ' . $row['last_name'] ?>
                        <!-- You can also use $_SESSION['name'] -->
                    </p>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>