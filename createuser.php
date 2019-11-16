<?php
session_start();
$newusername=$_POST['newusername'];
$newpassword=$_POST['newpassword'];

$conn=mysqli_connect("localhost","root","ftgyhuji","users") or die("couldn't connect!");
if(isset($newusername)){

$mysqlquery = "SELECT * FROM userslogin WHERE username=\"$newusername\"";

$res = $conn->query($mysqlquery);

        if($res->num_rows>0){

                $_SESSION['userexists']="That username already exists. Create a different one.";
                header("location:registere.php");
        }
        else{

        $sql = "INSERT INTO userslogin VALUE(\"$newusername\",\"$newpassword\")";

                if ($conn->query($sql) === TRUE) {
                        $_SESSION['newuser']="New user created";
                        header("location:logine.php");
                }
                else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                }

  }
}
?>

