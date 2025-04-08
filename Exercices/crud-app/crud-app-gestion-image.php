<?php 
session_start();

$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = trim($_POST['title']) ?? '';
    $category = $_POST['category'] ?? '';
    $imageName = $_FILES['image']['name'] ?? "";

    $id = 0;

    if (isset($_COOKIE['products'])) {
        $products = json_decode($_COOKIE['products'], true) ?? [];
        $id = count($products);
    }

    $old['title'] = $title;
    $old['category'] = $category;

    if ($title === '') {
        $errors['title'] = 'Title is not valid';
    }

    if ($category === "") {
        $errors['category'] = "Category is required";
    }

    if ($imageName === "") {
        $errors['image'] = 'Image is required';
    }

    // إذا كان فيه أخطاء، قم بتخزينها في الجلسة و اعادة التوجيه
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old ?? [];
        header('Location: crud-app-gestion-image.php');
        exit;
    }

    // إذا ما كانتش هناك أخطاء، خزّن المنتج
    $id++;
    $newProduct = [
        'id' => $id,
        'title' => $title,
        'category' => $category,
        'image' => $imageName,
    ];

    $products = [];

    if (isset($_COOKIE['products'])) {
        $products = json_decode($_COOKIE['products'], true) ?? [];
    }

    $products[] = $newProduct;
    setcookie('products', json_encode($products), time() + (24 * 60 * 60), '/');

    echo "<b style='color:green'>Product saved in cookies!</b>";
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
            background-color: #111827;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <?php
        $error = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];
        session_unset();
    ?>

    <div class="container" >
        <section class="bg-white dark:bg-gray-900 w-full">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new product</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">


                        <div class="sm:col-span-1">

                            <label for="idimg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID</label>
                            <input type="text" name="idimg" id="idimg" class="bg-dark-400 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-black-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="<?= $id?>" disabled>
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
</body>
</html>
