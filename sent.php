<?php
session_start();
if(!isset($_SESSION["register"])){
    header("Location: resup.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>rescue animals</title>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>welcome</h1>
        <p>rescued animal details are uploaded successfully</p>
       <!-- <div class="form-btn">
            <input type="submit"class="btn btn-primary" value="See details" name="submit">
        </div>
        <a href="logout.php" class="btn btn warning">Logout</a>-->
    </div>
</body>
</html>

