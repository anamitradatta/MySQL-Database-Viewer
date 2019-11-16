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
</style>
<h1>MySQL Info Viewer</h1>

<?php
echo '<ul>';
echo '<li style="float:right"><a href="logoute.php">Log out</a></li>';
echo '<li style="float:right"><a href="connectdatabasese.php">Database Selection</a></ul>';
session_start();
$db = $_POST['db'];

if(isset($db)){
$_SESSION['db']=$db;
}

if(isset($_SESSION['db'])){
        $servername = "localhost";
        $uname = "root";
        $pword = "ftgyhuji";
        // Create connection
        $cxn = new mysqli($servername, $uname, $pword, $_SESSION['db']);
        // Check connection
        if ($cxn->connect_error) {
                die("Connection to database failed: " . $cxn->connect_error);
        }
        else{
                //$sql = "select TABLE_NAME from information_schema.TABLES where TABLE_SCHEMA =\"$_SESSION['db']\"";
                $sql = "show tables";
                $result = $cxn->query($sql);
                echo '<div style="border-radius: 5px;background-color:#f2f2f2;padding:20px;width:20%">';
  echo "Please select the table you want to access";
                echo '<br><br>';
                echo '<form action="/cgi-bin/post_mysql_tables_htmle.cgi" method="post">'; 
                echo '<select name ="table">';
                while($row = $result->fetch_array(MYSQLI_NUM)) {
                        echo '<option value="'. $row[0] .'">' . $row[0] . '</option>';
                }
                echo '</select>';
                echo '<input type="hidden" name="db" value="'. $_SESSION['db'] .'">'; 
                echo '<br><br>';
                echo '<input type="submit" value="Submit" >';
                echo '</form>';
                echo '</div>';
        }
}

else{
        $_SESSION['notloggedin']="Please log in first";
        header("location:logine.php");
}
?>
</body>
</html>

