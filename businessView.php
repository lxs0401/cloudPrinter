<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/16
 * Time: 8:26
 */
session_start();
$con = mysql_connect("localhost","yundayin","CdAtaF4j57mfw8rT");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("yundayin", $con);
$user = $_SESSION["user"];
$pass = $_SESSION["pass"];
session_destroy();
$result = mysql_query("SELECT * FROM file WHERE printname= \"$user\"");
while($row = mysql_fetch_array($result)) {
    ?>
    <a href="<?php echo $row['filename'] ?>"><?php echo $row['filename'] ?></a><br \>
    <?php
}
