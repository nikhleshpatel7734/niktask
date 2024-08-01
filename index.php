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
    <h2 class="text-center">Register</h2>
        <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        
            <div class="form-group">
                <input type='text' name='name' class="form-control" placeholder='Name' required>
            </div>
            <div class="form-group">
                <input type='text' name='username' class="form-control" placeholder='Username' required>
            </div>
            <div class="form-group">
                <input type='email' name='email' class="form-control" placeholder='Email' required>
            </div>
            <div class="form-group">
                <input type='password' name='password' class="form-control" placeholder='Password' required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Must contain at least 8 characters, including letters and numbers">
            </div>
            <div class="form-group">
                <input type='password' name='cpassword' class="form-control" placeholder='Confirm Password' required>
            </div>
            <div class="form-group">
                <input type='date' name='date' class="form-control" placeholder='Date of Birth' required>
            </div>
            <div class="form-group">
                <select name="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <input type='text' name='address' class="form-control" placeholder='Address' required>
            </div>
            <div class="form-group">
                <input type='text' name='contact' class="form-control" placeholder='Mobile Number' required pattern="\d{10}" title="Enter a valid 10-digit mobile number">
            </div>
            <div class="form-group">
                <input type='file' name='img' class="form-control" required>
            </div>
            <div class="form-group text-center">
                <input type='submit' name='submit' value='Register' class='btn btn-primary'>
            </div>
        </form>
    </div>
    <script>
        function validateForm() {
            var password = document.forms[0]["password"].value;
            var cpassword = document.forms[0]["cpassword"].value;
            if (password != cpassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>

<?php
function handleFileUpload($file){
    $imagedata = file_get_contents($file['tmp_name']);
    return $imagedata;
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $img = handleFileUpload($_FILES['img']);

    if ($img) {
        $st = "INSERT INTO register (Name, Username, Email, Password, Dob, Gender, Address, Contact, Pimag) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $st);
        mysqli_stmt_bind_param($stmt, "sssssssss", $name, $username, $email, $password, $date, $gender, $address, $contact, $img);
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            echo "<script>
                    alert('User Registered Successfully');
                    window.location.href='login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('User Registration Failed');
                    window.location.href='index.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Image Upload Failed');
                window.location.href='index.php';
              </script>";
    }
}
?>
