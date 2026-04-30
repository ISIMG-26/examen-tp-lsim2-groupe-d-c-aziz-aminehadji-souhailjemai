<?php
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $checkEmail = "SELECT id FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $checkEmail);
        
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Cet email est déjà utilisé.'); window.location='auth.php';</script>";
        } else {
            $sql = "INSERT INTO users (nom, email, password) VALUES ('$nom', '$email', '$hashed_password')";
            if (mysqli_query($conn, $sql)) {
                header("Location: auth.php?success=1");
                exit();
            } else {
                echo "Erreur d'insertion: " . mysqli_error($conn);
            }
        }
    } else {
        echo "<script>alert('Les mots de passe ne correspondent pas.'); window.history.back();</script>";
    }
}
?>