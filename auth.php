<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mon Compte - LibraireOnline</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .msg-error { color: #ffffff; background: #e74c3c; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px; font-weight: 600; }
        .msg-success { color: #ffffff; background: #27ae60; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px; font-weight: 600; }
        .auth-container { max-width: 400px; margin: 50px auto; padding: 30px; background: white; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); color: #333; }
        .auth-container input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; color: #333; }
        .auth-container h3 { color: #1f2937; }
        .auth-container p { color: #1f2937; }
        .auth-container a { color: #e94560; }
    </style>
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
                <a href="auth.php" class="active">Compte</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="auth-container">
            <?php if(isset($_SESSION['user_id'])): ?>
                <div style="text-align: center;">
                    <h2 style="color: #000000;">Bonjour, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
                    <p style="color: #000000;">Vous êtes connecté à votre espace client.</p><br>
                    <a href="cart.php" class="btn" style="display:block; margin-bottom:10px; color: white;">Voir mon panier</a>
                    <a href="logout.php" class="btn" style="background: #c0392b; display:block; color: white;">Se déconnecter</a>
                </div>

            <?php else: ?>
                <?php if(isset($_GET['error'])): ?>
                    <div class="msg-error">Email ou mot de passe incorrect.</div>
                <?php endif; ?>

                <?php if(isset($_GET['msg']) && $_GET['msg'] == 'login_required'): ?>
                    <div class="msg-error">Veuillez vous connecter pour continuer.</div>
                <?php endif; ?>

                <?php if(isset($_GET['success'])): ?>
                    <div class="msg-success">Inscription réussie ! Connectez-vous.</div>
                <?php endif; ?>

                <div id="loginArea">
                    <h3 style="color: #000000;">Connexion</h3>
                    <form action="login.php" method="post">
                        <input type="email" name="email" placeholder="Votre Email" required>
                        <input type="password" name="password" placeholder="Mot de passe" required>
                        <button type="submit" class="btn" style="width:100%;">Entrer</button>
                    </form>
                    <p style="margin-top:15px; text-align:center; color: #000000;">Nouveau client ? <a href="#" onclick="toggleForm()" style="color: #e94560;">Créer un compte</a></p>
                </div>

                <div id="registerForm" style="display:none;">
                    <h3 style="color: #000000;">Inscription</h3>
                    <form action="register.php" method="post">
                        <input type="text" name="nom" placeholder="Nom complet" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Mot de passe" required>
                        <input type="password" name="confirm_password" placeholder="Confirmer mot de passe" required>
                        <button type="submit" class="btn" style="width:100%;">S'inscrire</button>
                    </form>
                    <p style="margin-top:15px; text-align:center; color: #000000;">Déjà inscrit ? <a href="#" onclick="toggleForm()" style="color: #e94560;">Se connecter</a></p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script>
        function toggleForm() {
            var login = document.getElementById('loginArea');
            var register = document.getElementById('registerForm');
            if (login.style.display === 'none') {
                login.style.display = 'block';
                register.style.display = 'none';
            } else {
                login.style.display = 'none';
                register.style.display = 'block';
            }
        }
    </script>
</body>
</html>