

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "crud";

// Create a connection
$mysqli = new mysqli($servername, $username, $password, $database) or die(mysqli_error($mysqli));

$id=0;
$update=false;
$name="";
$location="";

// Inserting a new record
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name,location) VALUES('$name','$location')") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been saved successfully.";
    $_SESSION['msg_type'] = "success"; 

    header("location: index.php");
}


//Deleting an existing record

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted.";
    $_SESSION['msg_type'] = "danger"; 

    header("location: index.php");
}


//Accessing the record which is to be edited

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
}


//Updating a record

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error);
    $_SESSION['message'] = "Record updated successfully";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}
?>