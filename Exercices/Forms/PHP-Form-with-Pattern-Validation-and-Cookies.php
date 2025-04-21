<?php
// Initialize variables to hold form data and errors
$name = $age = $url = $gender = "";
$errors = [];
$hobbies = [];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name (letters and spaces only)
    if (empty($_POST["name"])) {
        $errors["name"] = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $errors["name"] = "Only letters and spaces allowed";
        } else {
            setcookie("user_name", $name, time() + 86400, "/"); // 1 day expiration
        }
    }
    
    // Validate age (numbers only, between 1-120)
    if (empty($_POST["age"])) {
        $errors["age"] = "Age is required";
    } else {
        $age = test_input($_POST["age"]);
        
        if (!preg_match("/^[0-9]{1,3}$/", $age) || $age < 1 || $age > 120) {
            $errors["age"] = "Please enter a valid age (1-120)";
        } else {
            setcookie("user_age", $age, time() + 86400, "/");
        }
    }
    
    // Validate URL
    if (!empty($_POST["url"])) {
        $url = test_input($_POST["url"]);
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $errors["url"] = "Please enter a valid URL";
        } else {
            setcookie("user_url", $url, time() + 86400, "/");
        }
    }
    
    // Validate gender
    if (empty($_POST["gender"])) {
        $errors["gender"] = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
        setcookie("user_gender", $gender, time() + 86400, "/");
    }
    
    // Process hobbies
    if (isset($_POST["hobbies"]) && is_array($_POST["hobbies"])) {
        $hobbies = $_POST["hobbies"];
        setcookie("user_hobbies", implode(",", $hobbies), time() + 86400, "/");
    }
    
    // Validate selected option
    if (isset($_POST["options"]) && !empty($_POST["options"])) {
        $option = test_input($_POST["options"]);
        setcookie("user_option", $option, time() + 86400, "/");
    }
    
    // Handle image upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $allowed_types = ["image/jpeg", "image/png", "image/gif"];
        if (in_array($_FILES["image"]["type"], $allowed_types)) {
            // In a real application, you would save the file and store its path in a cookie
            // For demonstration, we'll just store the filename
            setcookie("user_image", $_FILES["image"]["name"], time() + 86400, "/");
        } else {
            $errors["image"] = "Invalid image format. Please upload JPG, PNG, or GIF";
        }
    }
    
    // Handle PDF upload
    if (isset($_FILES["filepdf"]) && $_FILES["filepdf"]["error"] === 0) {
        if ($_FILES["filepdf"]["type"] === "application/pdf") {
            // In a real application, you would save the file and store its path in a cookie
            // For demonstration, we'll just store the filename
            setcookie("user_pdf", $_FILES["filepdf"]["name"], time() + 86400, "/");
        } else {
            $errors["filepdf"] = "Invalid file format. Please upload a PDF";
        }
    }
    
    // If no errors, redirect to a success page or refresh
    if (empty($errors)) {
        // Optional: redirect to a success page
        header("Location: " . $_SERVER["PHP_SELF"] . "?success=1");
        exit;
    }
}

// Helper function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Load data from cookies if they exist
if (!empty($_COOKIE["user_name"])) $name = $_COOKIE["user_name"];
if (!empty($_COOKIE["user_age"])) $age = $_COOKIE["user_age"];
if (!empty($_COOKIE["user_url"])) $url = $_COOKIE["user_url"];
if (!empty($_COOKIE["user_gender"])) $gender = $_COOKIE["user_gender"];
if (!empty($_COOKIE["user_hobbies"])) $hobbies = explode(",", $_COOKIE["user_hobbies"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form with Pattern Validation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="number"],
        input[type="url"],
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        
        .error {
            color: red;
            font-size: 0.9em;
        }
        
        .success {
            background: #dff0d8;
            color: #3c763d;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .checkbox-group, .radio-group {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <?php if (isset($_GET["success"])): ?>
    <div class="success">
        <p>Form submitted successfully! Your information has been saved in cookies.</p>
    </div>
    <?php endif; ?>
    
    <h1>User Information Form</h1>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <!-- Name Input -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" pattern="[A-Za-z ]+" title="Only letters and spaces allowed">
            <?php if (isset($errors["name"])): ?>
                <span class="error"><?php echo $errors["name"]; ?></span>
            <?php endif; ?>
        </div>
        
        <!-- Age Input -->
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo $age; ?>" min="1" max="120">
            <?php if (isset($errors["age"])): ?>
                <span class="error"><?php echo $errors["age"]; ?></span>
            <?php endif; ?>
        </div>
        
        <!-- URL Input -->
        <div class="form-group">
            <label for="url">Website URL:</label>
            <input type="url" id="url" name="url" value="<?php echo $url; ?>" placeholder="https://example.com">
            <?php if (isset($errors["url"])): ?>
                <span class="error"><?php echo $errors["url"]; ?></span>
            <?php endif; ?>
        </div>
        
        <!-- Image Upload -->
        <div class="form-group">
            <label for="image">Profile Image (JPG, PNG, GIF):</label>
            <input type="file" id="image" name="image" accept="image/jpeg, image/png, image/gif">
            <?php if (isset($errors["image"])): ?>
                <span class="error"><?php echo $errors["image"]; ?></span>
            <?php endif; ?>
            <?php if (isset($_COOKIE["user_image"])): ?>
                <p>Current image: <?php echo $_COOKIE["user_image"]; ?></p>
            <?php endif; ?>
        </div>
        
        <!-- PDF Upload -->
        <div class="form-group">
            <label for="filepdf">PDF Document:</label>
            <input type="file" id="filepdf" name="filepdf" accept="application/pdf">
            <?php if (isset($errors["filepdf"])): ?>
                <span class="error"><?php echo $errors["filepdf"]; ?></span>
            <?php endif; ?>
            <?php if (isset($_COOKIE["user_pdf"])): ?>
                <p>Current PDF: <?php echo $_COOKIE["user_pdf"]; ?></p>
            <?php endif; ?>
        </div>
        
        <!-- Select Options -->
        <div class="form-group">
            <label for="options">Select an Option:</label>
            <select id="options" name="options">
                <option value="">-- Select an option --</option>
                <option value="option1" <?php if(isset($_COOKIE["user_option"]) && $_COOKIE["user_option"] == "option1") echo "selected"; ?>>Option 1</option>
                <option value="option2" <?php if(isset($_COOKIE["user_option"]) && $_COOKIE["user_option"] == "option2") echo "selected"; ?>>Option 2</option>
                <option value="option3" <?php if(isset($_COOKIE["user_option"]) && $_COOKIE["user_option"] == "option3") echo "selected"; ?>>Option 3</option>
            </select>
        </div>
        
        <!-- Radio Buttons for Gender -->
        <div class="form-group">
            <label>Gender:</label>
            <div class="radio-group">
                <input type="radio" id="male" name="gender" value="male" <?php if($gender == "male") echo "checked"; ?>>
                <label for="male">Male</label>
                
                <input type="radio" id="female" name="gender" value="female" <?php if($gender == "female") echo "checked"; ?>>
                <label for="female">Female</label>
                
                <input type="radio" id="other" name="gender" value="other" <?php if($gender == "other") echo "checked"; ?>>
                <label for="other">Other</label>
            </div>
            <?php if (isset($errors["gender"])): ?>
                <span class="error"><?php echo $errors["gender"]; ?></span>
            <?php endif; ?>
        </div>
        
        <!-- Checkboxes for Hobbies -->
        <div class="form-group">
            <label>Hobbies:</label>
            <div class="checkbox-group">
                <input type="checkbox" id="reading" name="hobbies[]" value="reading" <?php if(in_array("reading", $hobbies)) echo "checked"; ?>>
                <label for="reading">Reading</label>
                
                <input type="checkbox" id="sports" name="hobbies[]" value="sports" <?php if(in_array("sports", $hobbies)) echo "checked"; ?>>
                <label for="sports">Sports</label>
                
                <input type="checkbox" id="music" name="hobbies[]" value="music" <?php if(in_array("music", $hobbies)) echo "checked"; ?>>
                <label for="music">Music</label>
                
                <input type="checkbox" id="gaming" name="hobbies[]" value="gaming" <?php if(in_array("gaming", $hobbies)) echo "checked"; ?>>
                <label for="gaming">Gaming</label>
            </div>
        </div>
        
        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
    
    <?php if (isset($_COOKIE)): ?>
    <div>
        <h2>Stored Cookie Data:</h2>
        <ul>
            <?php foreach ($_COOKIE as $key => $value): ?>
                <?php if (strpos($key, 'user_') === 0): ?>
                    <li><strong><?php echo ucfirst(str_replace('user_', '', $key)); ?>:</strong> <?php echo $value; ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
</body>
</html>