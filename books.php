<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nos Livres - LibraireOnline</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>📚 LibraireOnline</h1>
            <nav>
                <a href="index.php">Accueil</a>
                <a href="books.php" class="active">Nos Livres</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="cart.php">Panier (<?php echo count($_SESSION['cart'] ?? []); ?>)</a>
                <?php endif; ?>
                <a href="auth.php">Compte</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="books-section">
            <h3>Nos Livres</h3>
            
            <div class="filter-container">
                <label>Filtrer par catégorie:</label>
                <select id="categoryFilter">
                    <option value="">Tous</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Science-fiction">Science-fiction</option>
                    <option value="Thriller">Thriller</option>
                </select>
                
                <input type="text" id="searchInput" placeholder="Chercher par titre ou auteur..." style="padding: 0.75rem 1rem; border: 2px solid var(--border); border-radius: 8px; min-width: 300px;">
                <button id="searchBtn" class="btn" style="padding: 0.75rem 1.5rem;">Rechercher</button>
            </div>

            <?php
            include("connexion.php");
            $sql = "SELECT * FROM books";
            $result = mysqli_query($conn, $sql);
            ?>

            <table class="books-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['titre'] . "</td>";
                    echo "<td>" . $row['auteur'] . "</td>";
                    echo "<td>" . $row['prix'] . " TND</td>";
                    echo "<td>" . $row['categorie'] . "</td>";
                    echo "<td>" . $row['stock'] . "</td>";
                    echo "<td>
                        <a href='book_detail.php?id=" . $row['id'] . "' class='btn-small'>Détails</a>";
                    if(isset($_SESSION['user_email']) && $_SESSION['user_email'] === 'admin@admin.com') {
                        echo " | <a href='admin_edit_book.php?id=" . $row['id'] . "' class='btn-small'>Modifier</a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 LibraireOnline. Tous droits réservés.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
