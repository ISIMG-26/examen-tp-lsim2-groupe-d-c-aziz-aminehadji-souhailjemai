<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier un Livre - LibraireOnline</title>
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
        <?php
        include("connexion.php");
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM books WHERE id = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        ?>
            <section class="form-section">
                <h3>Modifier un Livre</h3>
                <form action="update_book.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    
                    Titre: <input type="text" name="titre" value="<?php echo $row['titre']; ?>" required><br><br>
                    Auteur: <input type="text" name="auteur" value="<?php echo $row['auteur']; ?>" required><br><br>
                    Prix: <input type="number" step="0.01" name="prix" value="<?php echo $row['prix']; ?>" required><br><br>
                    Catégorie: <input type="text" name="categorie" value="<?php echo $row['categorie']; ?>" required><br><br>
                    Stock: <input type="number" name="stock" value="<?php echo $row['stock']; ?>" required><br><br>
                    Description: <textarea name="description" required><?php echo $row['description']; ?></textarea><br><br>
                    
                    <button type="submit" class="btn">Mettre à jour</button>
                </form>
                <a href="books.php" class="btn-back">← Retour</a>
            </section>
        <?php
        }
        ?>
    </main>

    <footer>
        <p>&copy; 2026 LibraireOnline. Tous droits réservés.</p>
    </footer>
</body>
</html>
