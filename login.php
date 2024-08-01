<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Infigo Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
<style>
        
        form {
            width: 50%;
            margin-left: 26%;
            border: 1px solid #ccc;
            border-radius: 7px;
        }
        .form-control {
            display: block;
            width: 83%;
            margin-left: 9%;
            margin-top: 5%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
                </style>
    <div class="container">
        <h2 class="text-center">Login</h2>
        <form action="" method="post">
            <div class="form-group">
                <input type='text' name='email' class="form-control" placeholder='Email' required>
            </div>
            <div class="form-group">
                <input type='password' name='password' class="form-control" placeholder='Password' required>
            </div>
            <div class="form-group text-center">
                <input type='submit' name='submit' value='Login' class='btn btn-primary'>
            </div>
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $st = "SELECT * FROM register WHERE Email = '$email' AND Password = '$password'";
    $res = mysqli_query($conn, $st);

    if(mysqli_num_rows($res) > 0){
        session_start();
        $_SESSION['email'] = $email;
        echo "<script>
                alert('Login Successful');
                window.location.href='dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Invalid Username or Password');
                window.location.href='login.php';
              </script>";
    }
}
?>
