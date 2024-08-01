<?php
session_start();
include("config.php");

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

$email = $_SESSION['email'];
$query = "SELECT * FROM register WHERE Email = '$email'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Infigo Task - Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        form {
            width: 50%;
            margin-left: 26%;
            border: 1px solid #ccc;
            border-radius: 7px;
            display: none;
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
        .btn.btn-danger, .btn.btn-primary {
            text-align: center;
            margin-left: 43.4%;
            margin-bottom:2%;
        }
        .profile-info {
            width: 40%;
           text-align:center;
           margin-left:30%;
            border: 1px solid #ccc;
            border-radius: 7px;
            padding: 20px;
        }
    </style>
    <script>
        function showUpdateForm() {
            document.getElementById('profile-info').style.display = 'none';
            document.getElementById('update-form').style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Dashboard</h2>

        <div id="profile-info" class="profile-info">
            <p><strong>Name:</strong> <?php echo $user_data['Name']; ?></p>
            <p><strong>Email:</strong> <?php echo $user_data['Email']; ?></p>
            <p><strong>Password:</strong> <?php echo $user_data['Password']; ?></p>
            <p><strong>Date of Birth:</strong> <?php echo $user_data['Dob']; ?></p>
            <p><strong>Gender:</strong> <?php echo $user_data['Gender']; ?></p>
            <p><strong>Address:</strong> <?php echo $user_data['Address']; ?></p>
            <p><strong>Contact:</strong> <?php echo $user_data['Contact']; ?></p>
            <p><strong>Profile Image:</strong> <img src="data:image/jpeg;base64,<?php echo base64_encode($user_data['Pimag']); ?>" alt="Profile Image" style='width:20%;'/></p>
            <button onclick="showUpdateForm()" class="btn btn-primary" style='margin-left: 4.4%;'>Update Profile</button>
            <a href="logout.php" class="btn btn-danger" style='margin-left: 4.4%;'>Log out</a>
        </div>

        <form id="update-form" action="update.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" id="name" name="name" value="<?php echo $user_data['Name']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" value="<?php echo $user_data['Email']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" value="<?php echo $user_data['Password']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <input type='date' name='date' class="form-control" value="<?php echo $user_data['Dob']; ?>">
            </div>
            <div class="form-group">
                <select name="gender" class="form-control">
                    <option value="<?php echo $user_data['Gender']; ?>" selected><?php echo $user_data['Gender']; ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <input type='text' name='address' class="form-control" value="<?php echo $user_data['Address']; ?>">
            </div>
            <div class="form-group">
                <input type='text' name='contact' class="form-control" value="<?php echo $user_data['Contact']; ?>" required pattern="\d{10}" title="Enter a valid 10-digit mobile number">
            </div>
            <div class="form-group">
                <input type='hidden' name='oldimg' value="<?php echo base64_encode($user_data['Pimag']); ?>" class="form-control">
                <input type='file' name='img' class="form-control">
            </div>
            <div class="form-group text-center">
                <input type="submit" value="Update Data" class="btn btn-primary" style='margin-left: 6.4%;'>
            </div>
        </form>
    </div>
</body>
</html>
