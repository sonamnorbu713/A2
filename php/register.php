<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPass = "";
$dbName = 'profile';

//creae a batabase connection

$conn = new mysqli($dbHost, $dbUsername,$dbPass,$dbName);
//verification that connection is built
if ($conn->connect_error){
    die("connection failed".$conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];


    $sql = "INSERT INTO users(id,username, password) VALUES ('$email',
    $username' ,$'password')";
    if ($conn->query($sql)===TRUE ){
        echo"Registration Successful";
        //take me back to the homepage
        sleep(2);
        header("location : home.html");
    }


}