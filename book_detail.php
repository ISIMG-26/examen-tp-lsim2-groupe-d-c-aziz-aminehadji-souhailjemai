<?php
session_start();
include("connexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Détail du Livre - LibraireOnline</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>📚 LibraireOnline</h1>
            <nav>
                <a href="index.php">Accueil</a>
                <a href="books.php">Nos Livres</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="cart.php">Panier (<?php echo count($_SESSION['cart'] ?? []); ?>)</a>
                <?php endif; ?>
                <a href="auth.php">Compte</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="detail-section">
            <div class="detail-container">
                <h2><?php echo $row['titre']; ?></h2>
                
                <div class="detail-content">
                    <div class="detail-info">
                        <p><strong>Auteur:</strong> <?php echo $row['auteur']; ?></p>
                        <p><strong>Catégorie:</strong> <?php echo $row['categorie']; ?></p>
                        <p><strong>Prix:</strong> <?php echo $row['prix']; ?> TND</p>
                        <p><strong>Stock disponible:</strong> <?php echo $row['stock']; ?></p>
                        <p><strong>Description:</strong></p>
                        <p><?php echo $row['description']; ?></p>

                        <div style="margin-top: 20px; border-top: 1px solid #ddd; padding-top: 20px;">
                        <?php
                        if ($row['stock'] > 0) {
                            if (isset($_SESSION['user_id'])) {
                                // USER IS LOGGED IN: Show Order Form
                                echo "<form action='add_order.php' method='post'>";
                                echo "<input type='hidden' name='book_id' value='" . $row['id'] . "'>";
                                echo "<input type='hidden' name='user_id' value='" . $_SESSION['user_id'] . "'>";
                                echo "<label>Quantité:</label> ";
                                echo "<input type='number' name='quantite' min='1' max='" . $row['stock'] . "' value='1' style='width: 60px; padding: 5px;'><br><br>";
                                echo "<button type='submit' class='btn'>Commander ce livre</button>";
                                echo "</form>";
                            } else {
                                // USER NOT LOGGED IN: Show Login Link
                                echo "<p style='color: #e74c3c;'><strong>Veuillez vous connecter pour passer une commande.</strong></p>";
                                echo "<a href='auth.php?msg=login_required' class='btn' style='display:inline-block; text-decoration:none;'>Se connecter pour commander</a>";
                            }
                        } else {
                            echo "<p style='color: red;'>Désolé, ce livre est actuellement hors stock.</p>";
                        }
                        ?>
                        </div>
                    </div>
                </div>

                <a href="books.php" class="btn-back" style="display:block; margin-top:20px;">← Retour aux livres</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 LibraireOnline. Tous droits réservés.</p>
    </footer>
</body>
</html>
<?php
    } else {
        echo "<p>Livre non trouvé</p>";
    }
}
?>