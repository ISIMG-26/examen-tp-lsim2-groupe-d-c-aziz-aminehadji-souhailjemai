<?php
session_start();
include("connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = (int)$_POST['book_id'];
    $qty = (int)$_POST['quantite'];

    $sql = "SELECT id, titre, prix FROM books WHERE id = $book_id";
    $res = mysqli_query($conn, $sql);
    $book = mysqli_fetch_assoc($res);

    if ($book) {
        if (isset($_SESSION['cart'][$book_id])) {
            $_SESSION['cart'][$book_id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$book_id] = [
                'titre' => $book['titre'],
                'prix' => $book['prix'],
                'qty' => $qty
            ];
        }
    }
    
    header("Location: cart.php");
    exit();
}
?>