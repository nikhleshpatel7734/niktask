<?php
session_start();
include("config.php");

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['date'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    if ($_FILES['img']['tmp_name']) {
        $img = file_get_contents($_FILES['img']['tmp_name']);
        $st = "UPDATE register SET Name=?, Email=?, Password=?, Dob=?, Gender=?, Address=?, Contact=?, Pimag=? WHERE Email=?";
        $stmt = mysqli_prepare($conn, $st);
        mysqli_stmt_bind_param($stmt, "sssssssss", $name, $email, $password, $dob, $gender, $address, $contact, $img, $_SESSION['email']);
    } else {
        $st = "UPDATE register SET Name=?, Email=?, Password=?, Dob=?, Gender=?, Address=?, Contact=? WHERE Email=?";
        $stmt = mysqli_prepare($conn, $st);
        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $password, $dob, $gender, $address, $contact, $_SESSION['email']);
    }

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['email'] = $email; 
        echo "<script>
                alert('Data Updated Successfully');
                window.location.href='dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Update Failed');
                window.location.href='dashboard.php';
              </script>";
    }
}
?>
