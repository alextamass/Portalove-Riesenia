<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}

include "menu.php";
?>
<br><br>
<form action="insert-item.php" method="post">
    <input type="text" name="name" value="" placeholder="Deal header"><br>
    <input type="text" name="url" value="" placeholder="Image URL"><br>
    <input type="submit" name="submit" value="Vlozit">
</form>
