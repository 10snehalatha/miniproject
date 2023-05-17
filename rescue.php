
<!DOCTYPE html>
<html>
<head>
    <title>Rescue Details</title>
    <meta charset="UTF-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="sty.css">
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
<?php

// SELECT statement to retrieve rescued animal details
require_once "database.php";
$sql = "SELECT * from rescue_animal";

// Execute the SELECT statement and store the results in a variable
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Loop through the rows and display the details on the web page
    while($row = $result->fetch_assoc()) {
        echo "<h2>Rescued Animal #" . $row["rescue_id"] . "</h2>";
        echo "<p>animal_type: " . $row["animal_type"] . "</p>";
        $image_data = $row["image_data"];
        $image_info = base64_encode($image_data);
        echo "<img src='data:image/png;base64," . $image_info . "' alt='" . $row["animal_type"] . "'>";
        echo "<p>Location: " . $row["location_data"] . "</p>";
    }
       
} else {
    echo "No rescued animals found.";
}
$conn->close();
?>
</body>
</html>
