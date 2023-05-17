
 
<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>

<body class="page1">
<header>
		<nav>
			<ul>
			    <li><a href="home.php">Home</a></li>
				<!---<li><a href="upload.php">Upload</a></li>-->
				<li><a href="volunteer.html">Volunteer</a></li>
				<li><a href="charity.php">Find a Charity</a></li>
				<li><a href="contacts.html">Contact Us</a></li>
			</ul>
		</nav>
</header>
    <div class="container">
        <?php

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        

        require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
        require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';

       /* require_once 'phpmailer/src/Exception.php';
        require 'phpmailer/src/PHPMailer.php';
        require 'phpmailer/src/SMTP.php';*/
        if(isset($_POST["submit"])){
            $fullname =$_POST["fullname"];
            $email =$_POST["email"];
            $password =$_POST["password"];
            $confirmpassword =$_POST["confirmpassword"];

            $password_hash = password_hash($password,PASSWORD_DEFAULT);
            $errors = array();

            if(empty($fullname) or empty($email) or empty($password) or empty($confirmpassword)){
              array_push($errors,"all fields are required");
            }
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                array_push($errors,"email provided is invalid");
            }
            if(strlen($password)<8){
                array_push($errors,"password contain atleast 8 characters");
            }
            if($password!==$confirmpassword){
                array_push($errors," password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM register WHERE email = '$email'";
            $result = mysqli_query($conn,$sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount>0){
                array_push($errors,"email already exists!!");
            }
            if(count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }else{
                //insert data into database
                //require_once "database.php";
                $sql = "INSERT INTO REGISTER (fullname,email,password) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                $preparestmt = mysqli_stmt_prepare($stmt,$sql);
                if($preparestmt){
                    //sendemail_verify("$fullname","$email");
                    mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$password_hash);
                    mysqli_stmt_execute($stmt);
                    /*echo "<div class='alert alert-success'>You are registered successfully.</div>";*/
                    
             
                $to = $email;
                $subject = "registration successful";
                $message = "Now you can be a part of this service";
                $headers = "From: Animal Welfare Website <noreply@animalwelfare.com>";
            
             $mail= new PHPMailer(true);
             try{
             /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/    
             $mail->isSMTP();
             $mail->Host='smtp.gmail.com';
             $mail->SMTPAuth   = true; 
             $mail->Username='snehalathar008@gmail.com';
             $mail->Password='qwxzredjoiscgang';
             $mail->SMTPSecure='ssl';
             $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
             $mail->Port=465;
             $mail->setFrom('snehalathar008@gmail.com','Animal Welfare Website');
             $mail->addAddress($_POST["email"]);
             $mail->isHTML(true);
             $mail->Subject=$subject;
             $mail->Body=$message;
             if($mail->send()){
                session_start();
                    $_SESSION["email"] = "yes";
                    header("Location: volsend.php");
                    die();
                /*echo "<div class='alert alert-success'>Email sent successfully.</div>";*/
            }else{
                echo "<div class='alert alert-danger'>Email sending failed.</div>";
            }
        }catch(Exception $e){
            /*die("something went wrong");*/
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
         }
         }
        }
        }
        ?>
        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text"class="form-control"name="fullname" placeholder="Full-Name:">
            </div>
            <div class="form-group">
                <input type="email"class="form-control"name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password"class="form-control"name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="password"class="form-control"name="confirmpassword" placeholder="ConfirmPassword:">
            </div>
            <div class="form-btn">
                <input type="submit"class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
    </div>    

</body>
</html>
