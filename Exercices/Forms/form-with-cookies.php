<?php

// Retrieve products from cookies
$products = isset($_COOKIE['products']) ? json_decode($_COOKIE['products'], true) : [];

// Add or Edit product handling
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['productName']) && !empty($_POST['price'])) {
    $productName = $_POST['productName'];
    $price = $_POST['price'];

    // If editing, update the existing product
    if (isset($_POST['btn-action']) && $_POST['btn-action'] == 'edit') {
        $indexToEdit = $_POST['editIndex'];
        $products[$indexToEdit] = ['name' => $productName, 'price' => $price];
    } else {
        // If adding new product
        $newProduct = ["name" => $productName, "price" => $price];
        $products[] = $newProduct;
    }

    // Save updated products to cookies
    setcookie("products", json_encode($products), time() + (24 * 60 * 60)); // Valid for 1 day
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Delete product handling
if (isset($_GET['delete'])) {
    $indexToDelete = $_GET['delete'];
    if (isset($products[$indexToDelete])) {
        unset($products[$indexToDelete]);
        $products = array_values($products); // Reindex array
        setcookie("products", json_encode($products), time() + (24 * 60 * 60));
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Edit product handling
if (isset($_GET['edit'])) {
    $indexToEdit = $_GET['edit'];
    if (isset($products[$indexToEdit])) {
        $productToEdit = $products[$indexToEdit];
        $_POST['productName'] = $productToEdit['name'];
        $_POST['price'] = $productToEdit['price'];
        $btnAction = "edit";
        $editIndex = $indexToEdit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container{
            width: 60vw;
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="card">
            <h3 class="card-header"><?php echo isset($btnAction) ? 'Edit Product' : 'Add New Product'; ?></h3>
            <div class="card-body">
                <form method="post">
                    <input type="text" class="form-control" name="productName" id="productName" placeholder="Enter product name" value="<?= isset($_POST['productName']) ? $_POST['productName'] : '' ?>" />
                    <input type="number" name="price" step="0.01" placeholder="Price" class="my-3 form-control" value="<?= isset($_POST['price']) ? $_POST['price'] : '' ?>">
                    
                    <?php if (isset($btnAction) && $btnAction == 'edit') : ?>
                        <input type="hidden" name="editIndex" value="<?= $editIndex; ?>">
                        <button name="btn-action" type="submit" class="btn btn-warning">Edit</button>
                    <?php else: ?>
                        <button name="btn-action" type="submit" class="btn btn-info">Add</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <table class="table table-rounded table-bordered">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php if (empty($products)) : ?>
                <tr>
                    <td colspan="3">No products found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($products as $index => $product) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?= htmlspecialchars($product['price']); ?> DH</td>
                        <td>
                            <a class="btn btn-danger" href="?delete=<?= $index; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                            <a class="btn btn-success" href="?edit=<?= $index; ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>
