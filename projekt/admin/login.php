<?php
session_start();
const USERNAME = "admin";
const PASSWORD = "admin";

if(isset($_POST['login'])) {
    if($_POST['username'] == USERNAME && $_POST['password'] == PASSWORD) {
        $_SESSION['login'] = true;
        header("Location: home.php");
    } else {
        header("Location: login.php?error=1");
    }
}

if(isset($_GET['error'])) {
    echo "<p style='color: red'>Nespravne meno alebo heslo</p><br>";
}
?>


<form method="post" action="">
    Meno<br>
    <input type="text" name="username" value="" placeholder="Username"><br>
    Heslo<br>
    <input type="password" name="password" value="" placeholder="Password"><br>
    <input type="submit" name="login" value="Prihlasit">
</form>
