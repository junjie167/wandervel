<?php
$email = $name = $nationality = $gender = $dob = $pwd_hashed = $errorMsg = "";
$success = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST["email"]);
        // Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $errorMsg .= "Invalid email format.<br>";
            $success = false;
        }
    }

    if (empty($_POST["name"])) {
        $errorMsg .= "Name is required.<br>";
        $success = false;
    } else {
        $name = sanitize_input($_POST["name"]);
    }
    if (empty($_POST["nationality"])) {
        $errorMsg .= "Nationality is required.<br>";
        $success = false;
    } else {
        $nationality = sanitize_input($_POST["nationality"]);
    }

    if (empty($_POST["gender"])) {
        $errorMsg .= "Gender is required.<br>";
        $success = false;
    } else {
        $gender = sanitize_input($_POST["gender"]);
    }

    if (empty($_POST["dob"])) {
        $errorMsg .= "Date of Birth is required.<br>";
        $success = false;
    } else {
        $current_date = date('yyyy-m-d');

        if ($_POST["dob"] > $current_date)
        {
            $errorMsg .= "Date cannot be in the future.<br>";
            $success = false;
        }else
        {
            $dob = sanitize_input($_POST["dob"]);
        }
        
    }



    if (empty($_POST["password"]) || empty($_POST["confirmPassword"])) {
        $errorMsg .= "Password and confirmation are required.<br>";
        $success = false;
    } else {
        $password = $_POST["password"];
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $errorMsg .= 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            $success = false;
        }else  if ($_POST["password"] != $_POST["confirmPassword"]) {
            $errorMsg .= "Passwords do not match.<br>";
            $success = false;
        } else {
            $pwd_hashed = password_hash($_POST["password"], PASSWORD_DEFAULT);
        }
      
    }
    if ($success) {
        saveMemberToDB();
        // echo $email;
        // echo $name;
        // echo $nationality;
        // echo $gender;
        // echo $dob;
        // echo $pwd_hashed;


    }
} else {
    echo "<h2> This page is not meant to be run directly</h2>";
    echo "<p>You can register at the link below:</p>";
    echo "<a href='signup.php'>Go to Sign Up page.....</a>";
    exit();
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<?php
/*
 * Helper function to write the member data to the DB
 */

function saveMemberToDB() {
    global $email, $name, $nationality, $gender, $dob, $pwd_hashed, $errorMsg, $success;
    // Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement:

        $stmt = $conn->prepare("INSERT INTO user (email, name, password, gender, dob, nationality) VALUES (?, ?, ?, ?, ?, ?)");
        // Bind & execute the query statement:
        $stmt->bind_param("ssssss", $email, $name, $pwd_hashed, $gender, $dob, $nationality);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<html>
    <?php include 'head.php'; ?>

    <body>
        <header>
            <?php
            include "navbar.php";
            ?>
        </header>

        <section>
            <div class="container">

                <hr>
                <?php
                if ($success) {

                    echo "<h3>Registration successful!</h3>";
                    echo "<h4>Thank you for signing up! " . $name . " !</h4>";
                    echo "<a href='login.php' class='btn btn-success'>Log In</a>";
                } else {

                    echo "<h1>OOPS!</h1>";
                    echo "<h4>The following input errors were detected:</h4>";
                    echo "<p>" . $errorMsg . "</p>";
                    echo "<a href='signup.php' class='btn btn-danger'>Return to Sign Up</a>";
                }
                ?>
            </div>
        </section>
        <br>

    </body>
    <?php
    include 'footer.php';
    ?>
</html>
