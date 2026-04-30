<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>LibraireOnline - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>📚 LibraireOnline</h1>
            <nav>
                <a href="index.php" class="active">Accueil</a>
                <a href="books.php">Nos Livres</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="cart.php">Panier (<?php echo count($_SESSION['cart'] ?? []); ?>)</a>
                <?php endif; ?>
                <a href="auth.php">Compte</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <h2>Bienvenue dans notre librairie en ligne</h2>
            <p>Découvrez nos sélections de livres</p>
        </section>

        <section class="books-section">
            <h3>Livres Populaires</h3>
            <?php
            include("connexion.php");
            $sql = "SELECT * FROM books LIMIT 6";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                echo "<div class='books-grid'>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='book-card'>";
                    echo "<h4>" . $row['titre'] . "</h4>";
                    echo "<p><strong>Auteur:</strong> " . $row['auteur'] . "</p>";
                    echo "<p><strong>Prix:</strong> " . $row['prix'] . " TND</p>";
                    echo "<p>" . substr($row['description'], 0, 50) . "...</p>";
                    echo "<a href='book_detail.php?id=" . $row['id'] . "' class='btn'>Voir détails</a>";
                    echo "</div>";
                }
                echo "</div>";
            }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 LibraireOnline. Tous droits réservés.</p>
    </footer>
</body>
</html>
