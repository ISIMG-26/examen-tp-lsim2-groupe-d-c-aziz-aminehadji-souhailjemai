<?php
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    $sql = "UPDATE books SET titre='$titre', auteur='$auteur', prix=$prix, categorie='$categorie', stock=$stock, description='$description' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: books.php");
    } else {
        echo "Erreur: " . mysqli_error($conn);
    }
}
?>
