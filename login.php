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

    function login($username, $password){
        /* CONNECTION */
        $conn = connection();

        /* SQL - Get the information of the username */
        $sql = "SELECT * FROM users WHERE username = '$username'";

        /* EXECUTION */
        $result = $conn -> query($sql);

        if ($result -> num_rows == 1){ // Check if username exists. num_rows は $result内の行数を返す。
            $row = $result -> fetch_assoc(); // $row に $result を 連想配列で取得
            if (password_verify($password, $row['password'])){ // Check if password is correct
                session_start();

                $_SESSION['user_id'] = $row['id']; // id of the person who logged in
                $_SESSION['username'] = $row['username']; 
                $_SESSION['full_name'] = $row['first_name'] . ' ' . $row['last_name']; 

                header('location: products.php');
                exit;
            }
            else{
                echo "<p class='text-danger'>Incorrect password.</p>";
            }
        }
        else{
            echo "<p class='text-danger'>Username not found.</p>";
        }
    }

    if(isset($_POST['btn_log_in'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        login($username, $password);
    }

?>
<body class="bg-light">
    <!-- vh・・・viewport height。ビューポートの高さに対する割合。 -->
    <div class="" style="height:100vh;">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto my-auto p-0">
                <div class="card-header text-primary bg-white">
                    <h1 class="card-title h3 mb-0">MiniMart Catalog</h1>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <label for="username" class="small">Username</label>
                        <input type="text" name="username" id="username" class="form-control mb-2" autofocus required>

                        <label for="password" class="small">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-5">

                        <button type="submit" name="btn_log_in" class="btn btn-primary btn-block w-100">Log in</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="signUp.php" class="small">Create Acount</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


<!-- 
    Password Verify
    password_verify()is another PHP built-in function that is used together with password_hash(). It verifies if the password from login matches the password from the database. It returns trueif match, and false　if not。
    Syntax: password_verify($login_password, $db_password);
    $login_password -the password from login form (e.g. “admin123”)
    $db_password -the hash from the database (e.g. “$2y$10$WNZ..

    Sessions
    Session variables are used as temporary storage of data which can be accessed across multiple pages. They are typically used to store information of the user who has currently logged in. Therefore, they are created on login and destroyed on logout.
    $_SESSION[]is a global array variable. You can set the name of the session variable inside the brackets.
        セッション変数は、複数のページにわたってアクセスできるデータの一時的な保存場所として使用され、一般的には、現在ログインしているユーザーの情報を保存するために使用する。したがって、ログイン時に作成され、ログアウト時に破棄されます。
        $_SESSION[]はグローバル配列変数です。括弧の中にセッション変数の名前を設定することができる。
    session_start() is used to start a session. This is required to be able to use session variables and functions.セッション開始時にセッション変数や関数を使用できるようにするために必要。
    session_unset() removes all session variables.
    session_destroy() destroys the session.

 -->