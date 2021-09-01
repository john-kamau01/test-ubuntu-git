<?php
//define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = $messageErr = "";
$name = $email = $gender = $message = $website = "";

//check if form has been submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["name"])){
        $nameErr = "Name is required";
    } else{
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if(empty($_POST["email"])){
        $emailErr = "Email is required";
    } else{
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if(empty($_POST["gender"])){
        $genderErr = "Gender is required";
    } else{
        $gender = test_input($_POST["gender"]);
    }

    if(empty($_POST["website"])){
        $websiteErr = "";
    } else{
        $website = test_input($_POST["website"]);
        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
            $websiteErr = "Invalid URL";
        }
    }

    if(empty($_POST["message"])){
        $messageErr = "";
    } else{
        $message = test_input($_POST["message"]);
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<html>
    <head>
        <title>Basic PHP Form</title>
        <style>
            .error{
                color: red;
            }
        </style>
    </head>

<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        Name: <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span><br><br>

        Email: <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span><br><br>

        Website: <input type="text" name="website" value="<?php echo $website; ?>">
        <span class="error"><?php echo $websiteErr;?></span><br><br>

        Gender: 
        <input type="radio" name="gender" <?php if(isset($gender) && $gender == "female" ) echo "checked" ?> value="female">Female
        <input type="radio" name="gender" <?php if(isset($gender) && $gender == "male" ) echo "checked" ?> value="male">Male
        <input type="radio" name="gender" <?php if(isset($gender) && $gender == "other" ) echo "checked" ?> value="other">Other
        <span class="error"><?php echo $genderErr; ?></span><br><br>

        Message: <textarea name="message" rows="5" cols="30"><?php echo $message; ?></textarea>
        <span class="error"><?php echo $messageErr; ?></span><br><br>
        <input type="submit">
    </form>
</body>
</html>

