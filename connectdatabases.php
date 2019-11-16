<html>
<body>
<style>
body{
background-color:lightseagreen;
}
h1{
color:black;
text-align:center;
}
input[type=submit] {
    width: 50%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}
select {
    width: 100%;
    padding: 16px 20px;
    border: none;

border-radius: 4px;
    background-color: white;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}

/style>
<h1>MySQL Info Viewer</h1>
<?php
echo '<ul>';
echo '<li style="float:right"><a href="logoute.php">Log out</a></li></ul>';
session_start();
$username=$_POST['username'];
$password=$_POST['password'];

if(isset($username)&&isset($password)){
$_SESSION['username']=$username;
$_SESSION['password']=$password;
}

if(isset($_SESSION['username'])&&isset($_SESSION['password'])){
        if(!empty($_SESSION['username'])&&!empty($_SESSION['password'])){
                $u = $_SESSION['username'];
                $p = $_SESSION['password'];
                $conn=mysqli_connect("localhost","root","ftgyhuji","users") or die("couldn't connect!");
                $res=mysqli_query($conn,"SELECT * FROM userslogin WHERE username='$u' && password='$p'");
                $count=mysqli_num_rows($res);
                if($count==1){
                        $servername = "localhost";
                        $uname = "root";
                        $pword = "ftgyhuji";
                // Create connection
                        $cxn = new mysqli($servername, $uname, $pword);
                        // Check connection
                        if ($cxn->connect_error) {
                                die("Connection to mysql failed: " . $cxn->connect_error);
}
                        else{
                                $sql = "show databases";
                                $result = $cxn->query($sql);
                                echo '<div style="border-radius: 5px;background-color:#f2f2f2;padding:20px;width:20%">';
                                echo "Please select the database you want to access";
                                echo '<br><br>';
                                echo '<form action="/html/connecttablese.php" method="post">'; 
                                echo '<select name ="db">';
                                while($row = $result->fetch_array(MYSQLI_NUM)) {
                                        echo '<option value="'. $row[0] .'">' . $row[0] . '</option>';
                                }
                                echo '</select>';                                       echo '<br><br>';
                                echo '<input type="submit" value="Submit" >';
                                echo '</form>';
 echo '</div>';
                        }
                }
                else{
                        $_SESSION['errMsg']="Invalid username or password";
                        header("location:logine.php");
                }
        }
        else{
                $_SESSION['empty']="Type in username or password";
                header("location:logine.php");
        }
}
else{
        $_SESSION['notloggedin']="Please log in first";
header("location:logine.php");
}
?>
</body>
</html>





