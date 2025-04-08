<?php
session_start();

// Initialize variables
$errors = [];
$old = [];
$id = 1;

// Calculate $id based on cookies (for both GET and POST requests)
if (isset($_COOKIE['products'])) {
    $products = json_decode($_COOKIE['products'], true) ?? [];
    $id = count($products) + 1;  // Set $id to the next available ID
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = trim($_POST['title']) ?? '';
    $category = $_POST['category'] ?? '';
    $imageName = $_FILES['image']['name'] ?? "";

    $old['title'] = $title;
    $old['category'] = $category;

    // Validate inputs
    if ($title === '') {
        $errors['title'] = 'Title is not valid';
    }

    if ($category === "") {
        $errors['category'] = "Category is required";
    }

    if ($imageName === "") {
        $errors['image'] = 'Image is required';
    } else {
        // Handle the image upload
        $uploadDir = 'uploads/';  // Directory to store uploaded images
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);  // Create the directory if it doesn't exist
        }

        $imagePath = $uploadDir . basename($imageName);
        $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

        // Validate file type
        if (!in_array($imageFileType, $allowedTypes)) {
            $errors['image'] = 'Only JPG, JPEG, PNG, GIF, and SVG files are allowed';
        }

        // Validate file size (e.g., max 5MB)
        if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            $errors['image'] = 'File size must be less than 5MB';
        }

        // If no errors, move the uploaded file
        if (empty($errors)) {
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $errors['image'] = 'Failed to upload image';
            }
        }
    }

    // If there are errors, store them in the session and redirect
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old ?? [];
        header('Location: crud-app-gestion-image.php');
        exit;
    }

    // If no errors, store the product
    $newProduct = [
        'id' => $id,
        'title' => $title,
        'category' => $category,
        'image' => $imagePath,  // Store the path to the uploaded image
    ];

    // Add the new product to the products array and update the cookie
    if (!isset($products)) {
        $products = [];  // Initialize $products if not already set
    }
    $products[] = $newProduct;
    setcookie('products', json_encode($products), time() + (24 * 60 * 60), '/');

    // Redirect to avoid form resubmission
    header('Location: crud-app-gestion-image.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            background-color: transparent;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .resultat {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <?php
        $error = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];
        session_unset();
    ?>

    <div class="container">
        <section class="bg-white dark:bg-gray-900 w-full">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new product</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-1">
                            <label for="idimg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID</label>
                            <input type="text" name="idimg" id="idimg" class="bg-dark-400 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-black-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="<?= $id ?>" disabled>
                        </div>

                        <div class="sm:col-span-1">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" id="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Image title">
                            <span class="error dark:text-rose-300"><?= $error['title'] ?? '' ?></span>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="" disabled>Select category</option>
                                <option value="TV" <?= ($old['category'] ?? '') == 'TV' ? 'selected' : '' ?>>Nature</option>
                                <option value="PC" <?= ($old['category'] ?? '') == 'PC' ? 'selected' : '' ?>>Humain</option>
                                <option value="GA" <?= ($old['category'] ?? '') == 'GA' ? 'selected' : '' ?>>Animal</option>
                                <option value="PH" <?= ($old['category'] ?? '') == 'PH' ? 'selected' : '' ?>>Abdo tigger</option>
                            </select>
                            <span class="error dark:text-rose-300"><?= $error['category'] ?? '' ?></span>
                        </div>

                        <div class="sm:col-span-2">
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                    </div>
                                    <input id="dropzone-file" name="image" type="file" class="hidden" />
                                </label>
                            </div>
                            <span class="error dark:text-rose-300"><?= $error['image'] ?? '' ?></span>
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:bg-rose-700 dark:focus:ring-primary-900 hover:bg-rose-800">
                        Add product
                    </button>
                </form>
            </div>
        </section>
    </div>

    <div class="resultat">
        <?php
        if (isset($_COOKIE['products'])) {
            $products = json_decode($_COOKIE['products'], true);
            if (!empty($products)) {
                foreach ($products as $product) {
                    echo '
                    <div>
                        <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['title']) . '">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">' . htmlspecialchars($product['title']) . '</h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">' . htmlspecialchars($product['category']) . '</p>
                            </div>
                        </a>
                    </div>';
                }
            } else {
                echo '<p class="text-gray-500 dark:text-gray-400">No products found.</p>';
            }
        } else {
            echo '<p class="text-gray-500 dark:text-gray-400">No products found.</p>';
        }
        ?>
    </div>

</body>
</html>