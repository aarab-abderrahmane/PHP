<?php
session_start(); 

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$products = [
    [
        'id' => 1,
        'intitule' => 'Ordinateur portable',
        'prix' => 899.99,
        'image' => 'https://picsum.photos/150/150?1'
    ],
    [
        'id' => 2,
        'intitule' => 'Smartphone',
        'prix' => 499.99,
        'image' => 'https://picsum.photos/150/150?2'
    ],
    [
        'id' => 3,
        'intitule' => 'Tablette',
        'prix' => 299.99,
        'image' => 'https://picsum.photos/150/150?3'
    ],
    [
        'id' => 4,
        'intitule' => 'Écouteurs sans fil',
        'prix' => 129.99,
        'image' => 'https://picsum.photos/150/150?4'
    ],
    [
        'id' => 5,
        'intitule' => 'Montre connectée',
        'prix' => 199.99,
        'image' => 'https://picsum.photos/150/150?5'
    ]
];

$page = isset($_GET['page']) ? $_GET['page'] : 'index';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if ($action === 'add_to_cart' && isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        
        foreach ($products as $product) {
            if ($product['id'] == $productId) {
                if (isset($_SESSION['panier'][$productId])) {
                    $_SESSION['panier'][$productId]['quantite']++;
                } else {
                    $_SESSION['panier'][$productId] = [
                        'id' => $product['id'],
                        'intitule' => $product['intitule'],
                        'prix' => $product['prix'],
                        'image' => $product['image'],
                        'quantite' => 1
                    ];    
                }
                break;
            }
        }

    } elseif ($action === 'increase' && isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        $_SESSION['panier'][$productId]['quantite']++;
  



    } elseif ($action === 'decrease' && isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        
        $_SESSION['panier'][$productId]['quantite']--;
        if ($_SESSION['panier'][$productId]['quantite'] <= 0) {
            unset($_SESSION['panier'][$productId]);
        }

        
    } elseif ($action === 'remove' && isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        unset($_SESSION['panier'][$productId]);
        
    }

    
   
    $_SESSION['panier'] = array_filter($_SESSION['panier'], function($item) {
        return $item['quantite'] > 0;
    });
    
    //redirects
    header('Location: ' . $_SERVER['PHP_SELF'] . ($page == 'panier' ? '?page=panier' : ''));
    exit;

}  


$cartCount = count($_SESSION['panier']);


$total = 0;
if ($page == 'panier' && !empty($_SESSION['panier'])) {
    $total = array_reduce(array_values($_SESSION['panier']), function($total, $item) {
        return $total + ($item['prix'] * $item['quantite']);
    }, 0);
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce - <?php echo $page == 'index' ? 'Produits' : 'Panier'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="?page=index">Mon E-commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page == 'index' ? 'active' : ''; ?>" href="?page=index">Produits</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="?page=panier" class="btn btn-outline-dark">
                        <i class="bi bi-cart-fill"></i> Panier
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $cartCount; ?></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <?php if ($page == 'index'): ?>
            <h1 class="mb-4">Nos produits</h1>
            
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($products as $product): ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['intitule']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['intitule']); ?></h5>
                                <p class="card-text"><?php echo number_format($product['prix'], 2, ',', ' '); ?> €</p>
                                <form method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                    <input type="hidden" name="action" value="add_to_cart">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-cart-plus"></i> Ajouter au panier
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            
        <?php else: ?>
            <h1 class="mb-4">Votre panier</h1>
            
            <?php if (empty($_SESSION['panier'])): ?>
                <div class="alert alert-info">
                    Votre panier est vide. <a href="?page=index" class="alert-link">Parcourir les produits</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Prix total HT</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['panier'] as $item): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['intitule']); ?>" style="width: 50px; height: 50px;">
                                    </td>
                                    <td><?php echo htmlspecialchars($item['intitule']); ?></td>
                                    <td><?php echo number_format($item['prix'], 2, ',', ' '); ?> €</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <form method="post" class="me-2">
                                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                                <input type="hidden" name="action" value="decrease">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">-</button>
                                            </form>
                                            
                                            <span><?php echo $item['quantite']; ?></span>
                                            
                                            <form method="post" class="ms-2">
                                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                                <input type="hidden" name="action" value="increase">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">+</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td><?php echo number_format($item['prix'] * $item['quantite'], 2, ',', ' '); ?> €</td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                            <input type="hidden" name="action" value="remove">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Total HT :</td>
                                <td class="fw-bold"><?php echo number_format($total, 2, ',', ' '); ?> €</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="?page=index" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Continuer les achats
                    </a>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

  
</body>
</html>