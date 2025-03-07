<?php
$host = "127.0.0.1";
$dbname = "restaurant_db"; // Vérifie que c'est le bon nom
$username = "root"; // Par défaut, XAMPP n'a pas de mot de passe
$password = ""; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}
?>
