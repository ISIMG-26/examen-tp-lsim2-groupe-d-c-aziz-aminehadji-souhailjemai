<?php
session_start();
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_item'])) {
    $book_id = (int)$_POST['remove_item'];
    if (isset($_SESSION['cart'][$book_id])) {
        unset($_SESSION['cart'][$book_id]);
    }
    header("Location: cart.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php?msg=login_required");
    exit();
}

$cart = $_SESSION['cart'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mon Panier - LibraireOnline</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>📚 LibraireOnline</h1>
            <nav>
                <a href="index.php">Accueil</a>
                <a href="books.php">Nos Livres</a>
                <a href="cart.php" class="active">Panier (<?php echo count($cart); ?>)</a>
                <a href="auth.php">Compte</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <h2 style="margin: 20px 0;">Votre Panier</h2>
        
        <?php if (empty($cart)): ?>
            <div style="background-color: rgba(26, 26, 46, 0.95); background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); padding: 30px; border-radius: 8px; text-align: center;">
                <p>Votre panier est vide.</p><br>
                <a href="books.php" class="btn">Parcourir les livres</a>
            </div>
        <?php else: ?>
            <table class="books-table" style="width:100%; background:white; border-collapse: collapse;">
                <tr style="background: #2c3e50; color: white;">
                    <th style="padding: 15px;">Livre</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                    <th>Actions</th>
                </tr>
                <?php 
                $grand_total = 0;
                foreach($cart as $id => $item): 
                    $total = $item['prix'] * $item['qty'];
                    $grand_total += $total;
                ?>
                <tr style="border-bottom: 1px solid #ddd; text-align: center;">
                    <td style="padding: 15px;"><?php echo htmlspecialchars($item['titre']); ?></td>
                    <td><?php echo $item['prix']; ?> €</td>
                    <td><?php echo $item['qty']; ?></td>
                    <td><?php echo $total; ?> TND</td>
                    <td>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="remove_item" value="<?php echo $id; ?>">
                            <button type="submit" class="btn-small" style="background: #ef4444; padding: 0.4rem 0.8rem; font-size: 0.8rem;">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr style="font-size: 1.2em; background: #f9f9f9;">
                    <td colspan="4" style="text-align:right; padding: 15px;"><strong>Total à payer:</strong></td>
                    <td><strong><?php echo $grand_total; ?> TND</strong></td>
                </tr>
            </table>
            
            <div style="margin-top: 20px; text-align: right;">
                <a href="books.php" class="btn" style="background: #7f8c8d; text-decoration:none;">Continuer mes achats</a>
                <button onclick="alert('Commande validée ! (Simulé)')" class="btn">Valider la commande</button>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>