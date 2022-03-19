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

    function createUser($first_name, $last_name, $username, $password){
        /* CONNECTION */
        $conn = connection();

        /* SQL */
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (`first_name`, `last_name`, `username`, `password`) VALUES ('$first_name', '$last_name', '$username', '$password')";

        /* EXECTION - $conn -> query($sql) */
        if($conn -> query($sql)){
            header("location: login.php");
            exit;
            //header関数によってページがリダイレクトされた後も、PHPの処理は続くので exit() で処理を終了させる。
        }
        else{
            die('Error adding new user: ' . $conn -> error);
        }
    }

    if(isset($_POST['btn_sign_up'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if Password and Confirm Password are the same.
        if($password === $confirm_password){
            // Call the function that will insert data into the database.
            createUser($first_name, $last_name, $username, $password);
        }
        else{
            echo "<p class='text-danger'>Password and Confirm Password do not match.</p>";
        }
    }

?>
<body class="bg-light">
    <!-- vh・・・viewport height。ビューポートの高さに対する割合。 -->
    <div class="" style="height:100vh;">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto my-auto p-0">
                <div class="card-header text-success">
                    <h1 class="card-title bg-light h3 mb-0">Create your account</h1>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <label for="first_name" class="small">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control mb-2" required autofocus>

                        <label for="last_name" class="small">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control mb-2" required>

                        <label for="username" class="small fw-bold">Username</label>
                        <input type="text" name="username" id="username" class="form-control mb-2 fw-bold" maxlength="15" required>

                        <label for="password" class="small">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" required>

                        <label for="confirm_password" class="small">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control mb-5" required>

                        <button type="submit" name="btn_sign_up" class="btn btn-success btn-block w-100">Sign Up</button>
                    </form>

                    <div class="text-center mt-3">
                        <p class="small">Already have an account? <br><a href="login.php">Log in.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<!-- 
    password_hash() is a built-in PHP function that transforms any text into a password hash. 
    Syntax: password_hash($login_password, $algorithm);
    This function accepts 2 arguments. The first argument is the user’s password. The second argument is the algorithm that will be used. In this case, we used the PASSWORD_DEFAULTand it uses the strongest supported algorithm. Currently, it is PASSWORD_BCRYPTwhich returns a 60-character string that begins with "$2y$”.
    Example: 
    $password = password_hash(“admin123”, PASSWORD_DEFAUL
    $password = $2y$10$WNZrznemKHOI6M0FCA6kp.Afb3kM.pAwo8tJjL4Etlb35kZMZMW
    →　“admin123” is translated into a 60-character hash.
-->