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
input[type=text], select {
width:100%;
padding: 12px 20px;
margin:8px 0;
display: inline-block;
border:1px solid #ccc;
border-radius:4px;
box-sizing:border-box;
}

input[type=password], select {
width:100%;
padding: 12px 20px;
margin:8px 0;
display: inline-block;
border:1px solid #ccc;
border-radius:4px;
box-sizing:border-box;

}

input[type=password], select {
width:100%;
padding: 12px 20px;
margin:8px 0;
display: inline-block;
border:1px solid #ccc;
border-radius:4px;
box-sizing:border-box;
}
input[type=submit] {
    width: 100%;
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

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}
li{
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
<h1> MySQL Info Viewer</h1>
<?php
if(isset($_GET['logout'])){
session_start();
session_destroy();
echo '<font color ="red">';
echo "You have been logged out";
echo '</font>';
}
?>

<?php session_start(); ?>
    <body>
        <div id="notloggedin">
            <?php if(!empty($_SESSION['notloggedin'])) { echo '<font color ="red">';
echo $_SESSION['notloggedin']; 
echo '</font>';
} ?>
        </div>

<?php unset($_SESSION['notloggedin']); ?>
    </body>
<?php session_start(); ?>
    <body>
        <div id="errMsg">
            <?php if(!empty($_SESSION['errMsg'])) { echo '<font color ="red">';
echo $_SESSION['errMsg']; 
echo '</font>';
} ?>
        </div>
        <?php unset($_SESSION['errMsg']); ?>
    </body>
<?php session_start(); ?>
    <body>
        <div id="empty">
 <?php if(!empty($_SESSION['empty'])) { echo '<font color ="red">';
echo $_SESSION['empty']; 
echo '</font>';
} ?>
        </div>
        <?php unset($_SESSION['empty']); ?>
    </body>
<?php session_start(); ?>
    <body>
        <div id="newuser">
            <?php if(!empty($_SESSION['newuser'])) { echo '<font color ="red">';
echo $_SESSION['newuser']; 
echo '</font>';
} ?>
        </div>
 <?php unset($_SESSION['newuser']); ?>
    </body>
<ul>
        <li style="float:right"><a href="registere.php">Register</a></li>
</ul>
<div style="border-radius: 5px;background-color:#f2f2f2;padding:20px;width:15%">
<form action="/html/connectdatabasese.php" method="post">
<label for="uname">username</label><br>
<input type="text" name="username" placeholder="Type in username here"><br>
<label for="pword">password</label> <br>
<input type="password" name="password" placeholder="Type in password here"><br>
<input type="submit" value="Log in">
</form>
</div>
</body>

</html>






<?php

header("location:logine.php?logout=1");

?>

