<?php 
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "wp"; 
    include('../php/displayMessageAndRedirect.php');
 
    // Create connection 
    $conn = mysqli_connect($servername, $username, $password, $dbname); 
    // if(!$conn){ 
    //     echo "Error"; 
    // } 
    if(isset($_POST['sendMessage'])){ 
        $name = $_POST['name']; 
        $email = $_POST['email']; 
        $message = $_POST['message']; 
 
        $query = "INSERT INTO msg (name, email, message) VALUES ('$name', '$email', '$message')"; 
        mysqli_query($conn, $query); 
        displayMessageAndRedirect("Recipe successfully added", "../html/contact.html"); 
        } 
     
    else{ 
        echo "Error"; 
    } 
?>