<?php
 session_start(); 
?>
<!DOCTYPE html>
<html>
<?php


$e = $_SESSION["email"];
$id = $_SESSION["user_id"];

echo "Welcome, " . $_SESSION["email"];

// if user isn't logged in, will redirect them back to login page
if(!isset($_SESSION["user_id"]))
{
    header("Location:login.php");
}


global $name, $gender, $email, $dob, $nationality, $bio, $pwd_hashed, $profilepic, $userid;
  // Create database connection
  $config = parse_ini_file('../../private/db-config.ini');
  $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

  if($conn->connect_error){
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}else{
    // Prepare the statement
    $stmt = $conn->prepare("SELECT * FROM user WHERE email= '".$_SESSION['email']."'");
    
    // Bind and execute
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        // Note that email field is unique
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $id = $row["user_id"];
        $gender = $row["gender"];
        $dob = $row["dob"];
        $nationality = $row["nationality"];
        $bio = $row["bio"];
        $pwd_hashed = $row["password"];  
        $profilepic = $row["profile_picture"];
    }


}
$conn->close();
?>

<head>
<header>
            <?php
            include "navbar.php";
            ?>
        </header> 
</head>
    <?php
    include "head.php";
    ?>
 <body>
        <section>
            <main class="container">   
            <form action="userProfile.php" method="post" enctype="multipart/form-data">
                   
                <div>
                        <label for="profile_picture"><a>Profile Picture:</a></label>
                        <input type="file" name="image"  value="<?php echo $profilepic; ?>"/>
                    </div>

                    <div>
                        <label for="name"><a>Name:</a></label>
                        <input type="text" name="name"  value="<?php echo $name; ?>"/>
                    </div>

                    <div>
                        <label for="gender"><a>Gender:</a></label>
                        <input type="text" name="gender"  value="<?php echo $row['gender']; ?>"/>
                    </div>
                    <div>
                        <label for="dob"><a>Date of Birth:</a></label>
                        <input name="dob" value="<?php echo $row['dob']; ?>"/>
                    </div>
                    <div>
                        <label for="nationality"><a>Nationality:</a></label>
                        <input name="nationality" value="<?php echo $row['nationality']; ?>"/>
                    </div>
                    <div>
                        <label for="bio"><a>About Yourself:</a></label>
                        <input name="bio" value="<?php echo $row['bio']; ?>"/>
                    </div>
                    <input type="submit"  value="Update">
                    <div>
                    </div>

                </form>
            </main>
        </section>
    </body>
    <?php
    include "footer.php";
    ?>
</html> <?php
 session_start(); 
?>
<!DOCTYPE html>
<html>
<?php


$e = $_SESSION["email"];
$id = $_SESSION["user_id"];

echo "Welcome, " . $_SESSION["email"];

// if user isn't logged in, will redirect them back to login page
if(!isset($_SESSION["user_id"]))
{
    header("Location:login.php");
}


global $name, $gender, $email, $dob, $nationality, $bio, $pwd_hashed, $profilepic, $userid;
  // Create database connection
  $config = parse_ini_file('../../private/db-config.ini');
  $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

  if($conn->connect_error){
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}else{
    // Prepare the statement
    $stmt = $conn->prepare("SELECT * FROM user WHERE email= '".$_SESSION['email']."'");
    
    // Bind and execute
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        // Note that email field is unique
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $id = $row["user_id"];
        $gender = $row["gender"];
        $dob = $row["dob"];
        $nationality = $row["nationality"];
        $bio = $row["bio"];
        $pwd_hashed = $row["password"];  
        $profilepic = $row["profile_picture"];
    }


}
$conn->close();
?>

<head>
<header>
            <?php
            include "navbar.php";
            ?>
        </header> 
</head>
    <?php
    include "head.php";
    ?>
 <body>
        <section>
            <main class="container">   
            <form action="userProfile.php" method="post" enctype="multipart/form-data">
                   
                <div>
                        <label for="profile_picture"><a>Profile Picture:</a></label>
                        <input type="file" name="image"  value="<?php echo $profilepic; ?>"/>
                    </div>

                    <div>
                        <label for="name"><a>Name:</a></label>
                        <input type="text" name="name"  value="<?php echo $name; ?>"/>
                    </div>

                    <div>
                        <label for="gender"><a>Gender:</a></label>
                        <input type="text" name="gender"  value="<?php echo $row['gender']; ?>"/>
                    </div>
                    <div>
                        <label for="dob"><a>Date of Birth:</a></label>
                        <input name="dob" value="<?php echo $row['dob']; ?>"/>
                    </div>
                    <div>
                        <label for="nationality"><a>Nationality:</a></label>
                        <input name="nationality" value="<?php echo $row['nationality']; ?>"/>
                    </div>
                    <div>
                        <label for="bio"><a>About Yourself:</a></label>
                        <input name="bio" value="<?php echo $row['bio']; ?>"/>
                    </div>
                    <input type="submit"  value="Update">
                    <div>
                    </div>

                </form>
            </main>
        </section>
    </body>
    <?php
    include "footer.php";
    ?>
</html> 