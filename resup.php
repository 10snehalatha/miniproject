
<!DOCTYPE html>
<html>
<head>
	<title>rescue form</title>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="sp.css">
</head>
<body>
<header>
		<nav>
			<ul>
			    <li><a href="home.php">Home</a></li>
				<!--<li><a href="upload.php">Upload</a></li>-->
				<li><a href="volunteer.html">Volunteer</a></li>
				<li><a href="charity.php">Find a Charity</a></li>
				<li><a href="contacts.html">Contact Us</a></li>
			</ul>
		</nav>
</header>

    <div class ="container">
	<?php
	require_once "database.php";
	if (isset($_POST["submit"])) {
		// Get the animal type and image data from the form
		$rescue_id = mysqli_real_escape_string($conn, $_POST['rescue_id']);
		$animal_type = mysqli_real_escape_string($conn, $_POST['animal-type']);
		$image_data = addslashes(file_get_contents($_FILES['animal-photo']['tmp_name']));
		//$folder = "uploads/".$image_data;
		$location_data = mysqli_real_escape_string($conn, $_POST['location_data']);
	   // var_dump($_POST['location_data']);
		// Insert the data into the database
		$sql = "INSERT INTO rescue_animal (rescue_id, animal_type, image_data, location_data) VALUES ('$rescue_id','$animal_type', '$image_data', '$location_data')";
		if (mysqli_query($conn, $sql)) {
			/*echo "rescue animal details are uploaded  successfully.";*/

		session_start();
        $_SESSION["register"] = "yes";
        header("Location: sent.php");
        die();
		}
	}
    ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

          <label for="animal-id">Animal id:</label>
          <input type="text" id="animal-id" name="rescue_id" required>
          <label for="animal-type">Animal Type:</label>
<!--<select id="animal-type" name="animal-type" required>
    <option value="dog">Dog</option>
    <option value="cat">Cat</option>
    <option value="cow">Cow</option>
    <option value="other">Other</option>
</select>-->
        <input type="text" id="animal-type" name="animal-type" required>

        <label for="animal-photo">Animal Photo:</label>
        <input type="file" id="animal-photo" name="animal-photo" required>

        <label for="animal-location">Animal Location:</label>
        <input type="text" id="location_data" name="location_data" required>

<!--<label for="animal-description">Animal Description:</label>
<textarea id="animal-description" name="animal_description"></textarea>-->
       <br><br>
        <input type="submit" name="submit" value="Submit">
       </form>
    </div>    
</body>
</html>