<?php
session_start();
include("connexion.php");

$category = isset($_GET['category']) ? $_GET['category'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

if ($search) {
    $search = mysqli_real_escape_string($conn, $search);
    $sql = "SELECT * FROM books WHERE titre LIKE '%$search%' OR auteur LIKE '%$search%'";
} elseif ($category) {
    $category = mysqli_real_escape_string($conn, $category);
    $sql = "SELECT * FROM books WHERE categorie = '$category'";
} else {
    $sql = "SELECT * FROM books";
}

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['titre'] . "</td>";
    echo "<td>" . $row['auteur'] . "</td>";
    echo "<td>" . $row['prix'] . " €</td>";
    echo "<td>" . $row['categorie'] . "</td>";
    echo "<td>" . $row['stock'] . "</td>";
    echo "<td>
        <a href='book_detail.php?id=" . $row['id'] . "' class='btn-small'>Détails</a>";
    if(isset($_SESSION['user_email']) && $_SESSION['user_email'] === 'admin@admin.admin') {
        echo " | <a href='admin_edit_book.php?id=" . $row['id'] . "' class='btn-small'>Modifier</a>";
    }
    echo "</td>";
    echo "</tr>";
}
?>
