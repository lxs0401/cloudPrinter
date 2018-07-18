<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else {
        $hashname = hash_file('sha256', $_FILES["file"]["tmp_name"], false);
        if (file_exists("upload/" . "$hashname." . substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1)) == false) {
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . "$hashname." . substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1));
        }
        $username = $_POST["username"];
        $printname = $_POST["printname"];

        $con = mysql_connect("localhost", "yundayin", "CdAtaF4j57mfw8rT");
        if (!$con) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("yundayin", $con);
        $result = mysql_query("SELECT * FROM users WHERE username= \"$printname\" and type = \"2\"");
        $row = mysql_fetch_array($result);
        if ($row == null) {
            echo "<script type='text/javascript'>alert(\"不存在该店家\");</script>";
            echo "<script>window.location.href='loginView.php';</script> ";
        }
        mysql_query("INSERT INTO file (username, printname, filename)VALUES (\"$username\", \"$printname\",\"upload/" . "$hashname." . substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1) . "\")");
        mysql_close($con);
        echo "SUCCESS";
    }

?>