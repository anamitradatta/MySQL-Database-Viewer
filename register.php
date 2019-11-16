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

nput[type=submit] {
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
<h1> MySQL Info Viewer</h1>

<ul>

 <li style="float:right"><a href="logine.php">Log in</a></li>
</ul>
<?php session_start(); ?>
    <body>
        <div id="userexists">
            <?php if(!empty($_SESSION['userexists'])) { echo '<font color ="red">';
echo $_SESSION['userexists']; 
echo '</font>';
} ?>
        </div>
        <?php unset($_SESSION['userexists']); ?>
    </body>
<div style="border-radius: 5px;background-color:#f2f2f2;padding:20px;width:15%">
<?php

echo '<form action="/html/createusere.php" method="post">';
echo '<label for="uname">Type in a username</label><br>';
echo '<input type="text" name="newusername" placeholder="Type in a username here"><br>';
echo '<label for="pword">Type in a password</label><br>';
echo '<input type="text" name="newpassword" placeholder="Type in a password here"><br>';
echo '<input type="submit" value="Create User">';
echo '</form>';
?>
</div>
</body>
</html>

