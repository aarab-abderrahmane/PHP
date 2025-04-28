<?php
    include "connection-db.php";
    include "user_info.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $errors = [];

        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $category = isset($_POST['category']) ? (int)$_POST['category'] : '';
        $image_name = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

        // Validate fields
        if (empty($title) || !preg_match('/^[a-zA-Z]{5,}$/', $title)) {
            $errors['title'] = "Invalid name, at least 5 letters.";
        }

        if (empty($description) || strlen($description) < 10) {
            $errors["description"] = "Description must be longer than 10 characters.";
        }

        if (empty($category)) {
            $errors["category"] = "Please select a category.";
        }

        // Validate image
        if (!empty($image_name)) {
            $image_path = $_FILES['image']['tmp_name'];
            
            // Check if file was uploaded successfully
            if (!is_uploaded_file($image_path) && $_FILES['image']['error'] ==0) {
                $errors['image'] = "File upload failed.";

            } else {

                
                $imageFileType = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'jpeg', 'gif', 'png'];


                if (!in_array($imageFileType, $allowedTypes)) {
                    $errors['image'] = "Only jpg, jpeg, gif, png files are allowed.";
                    
                } elseif ($_FILES['image']['size'] > 10 * 1024 * 1024) {
                    $errors['image'] = "File size must be less than 10 MB.";

                }else{
                    $imageData = file_get_contents($_FILES['image']['tmp_name']);
                    $imageData = mysqli_real_escape_string($connection, $imageData);
                }
            }
        } else {
            $errors['image'] = "Please choose an image.";
        }

        if (empty($errors)) {
            $sql_insert = "INSERT INTO todouser (titleTodo, textTodo, idCat, image, idUser) 
                            VALUES ('$title','$description','$category','$imageData','$id_user')";

            // Prepare the statement
            if(mysqli_query($connection,$sql_insert)){

                    echo '<div class="alerts">
                            <div id="success-alert" class="relative w-full max-w-160 flex flex-wrap items-center justify-center py-3 px-4 rounded-lg text-base font-medium transition-all duration-500 border border-green-500 text-green-700 bg-green-100">
                                <button id="close-success-btn" type="button" aria-label="close-success" class="absolute right-4 p-1 rounded-md transition-opacity text-green-500 border border-green-500 opacity-40 hover:opacity-100">
                                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="16" width="16" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </button>
                                <p class="flex flex-row items-center justify-center gap-x-2 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="mr-9">Data successfully inserted! <a href="dashboard.php">Back to home page.</a></span>
                                </p>
                            </div>
                        </div>';
            } else {
                    echo '<div class="alerts">
                            <div id="danger-alert" class="relative w-full max-w-140 flex flex-wrap items-center justify-center py-3 px-4 rounded-lg text-base font-medium transition-all duration-500 border border-red-500 text-red-700 bg-red-100">
                                <button id="close-danger-btn" type="button" aria-label="close-success" class="absolute right-4 p-1 rounded-md transition-opacity text-red-500 border border-red-500 opacity-40 hover:opacity-100">
                                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="16" width="16" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </button>
                                <p class="flex flex-row items-center justify-center gap-x-2 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <span class="mr-8">Error in executing the query: ' . mysqli_error($connection) . '</span>
                                </p>
                            </div>
                        </div>';
                }


        }}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .error {
            color: yellow;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: monospace;
            font-size: 1.1rem;
        }
        .container {
            width: 60vw;
        }
    </style>
</head>
<body>
    <div>
        
    </div>

    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>">
            <?php
                if (isset($errors['title'])) {
                    echo '<p class="error">' . $errors['title'] . '</p>';
                }
            ?>

            <label for="description">Description</label>
            <textarea id="description" rows="10" name="description"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
            <?php
                if (isset($errors['description'])) {
                    echo '<p class="error">' . $errors['description'] . '</p>';
                }
            ?>

            <label for="category">Category</label>
            <select id="category" name="category">
                <option value="" <?= isset($_POST['category']) ? '' : 'selected' ?> disabled>Select category</option>
                <?php
                    $category_query = "SELECT * FROM categorie";
                    $category_result=mysqli_query($connection,$category_query);

                    if ($category_result && mysqli_num_rows($category_result) > 0) {
                        while ($row = mysqli_fetch_assoc($category_result)) {
                            $selected = (isset($_POST['category']) && ($_POST['category'] == $row['idCat'])) ? 'selected' : "";
                            echo "<option value='" . $row['idCat'] . "' $selected>" . $row['libelle'] . "</option>";
                        }
                    } else {
                        echo "<option>No categories available</option>";
                    }
                ?>
            </select>
            <?php
                if (isset($errors['category'])) {
                    echo '<p class="error">' . $errors['category'] . '</p>';
                }
            ?>

            <label for="image">Image</label>
            <input type="file" id="image" name="image">
            <?php
                if (isset($errors['image'])) {
                    echo '<p class="error">' . $errors['image'] . '</p>';
                }
            ?>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
