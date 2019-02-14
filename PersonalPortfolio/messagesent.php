<?php
    try {
        include("database.php");
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }

    $db = Database::getDB();
    //collect all info from the form
    $fname = filter_input(INPUT_POST, 'fName');
    $lname = filter_input(INPUT_POST, 'lName');
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phoneNumber');
    $company = filter_input(INPUT_POST, 'compName');
    $message = filter_input(INPUT_POST, 'comments');
    
    
    // Validate inputs
    if ($fname == null || $lname == null ||
        $email == null || $message == null) {
        $error = "Invalid input data. Check all fields and try again.";
        echo "Form Data Error: " . $error; 
        exit();
        } else {
            $db = Database::getDB();
            
            // Add the visitor to the database  
            $query = 'INSERT INTO visitors
                         (firstname, lastname, email, phone, company, comments)
                      VALUES
                         (:fname, :lname, :email, :phone, :company, :message)';
            $statement = $db->prepare($query);
            $statement->bindValue(':fname', $fname);
            $statement->bindValue(':lname', $lname);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':phone', $phone);
            $statement->bindValue(':company', $company);
            $statement->bindValue(':message', $message);
            $statement->execute();
            $statement->closeCursor();
}

function getName($name) {
    return $name;
    }
?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<link rel="stylesheet" href="css/styles.css">
	<title>Aaron's Portfolio</title>
	<meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<header>
	<h1 class="work">Thank You</h1>
	</header>
	
	<nav>
		<ul>
			<li><a href="index.html">Home</a></li>
			<li><a href="education.html">Education</a></li>
			<li><a href="work.html">Previous Work</a></li>
			<li><a href="contact.html">Contact Me</a></li>
                        <li><a href="adminlogin.php">Admin</a></li>
		</ul>
	</nav>
	
	<main>
            <div id="container">
            <h2>Thanks for the message <?php echo getName($fname); ?>. I will get back to you as soon as possible!</h2>
            </div>
	</main>
	
	<footer>
	<div class="contact">
	<p>&copy; Copyright 2018. All Rights Reserved.<br>
	Phone: <a href="tel:12085627078">(208) 562-7078</a><br>
	Email: <a href="mailto:brandis621@gmail.com">Brandis621@gmail.com</a></p>
	</div>
	
	<div class="social">
	<p>Connect with me on Social Media:</p>
	<a href="https://www.linkedin.com" target="_blank">
		<img src="images/linkedin.svg" alt="Linkedin Logo"></a>
	<a href="https://www.github.com" target="_blank">
		<img src="images/github.svg" alt="GitHub Logo"></a>
	<a href="https://www.youtube.com/channel/UCEpjS2Q7VdE34_qs7R9Rpgw" target="_blank">
		<img src="images/youtube.svg" alt="Youtube Logo"></a>
	</div>
	
	</footer>
	
</body>
</html>