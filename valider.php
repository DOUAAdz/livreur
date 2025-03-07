<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $sql = "UPDATE livreurs SET statut = 'Validé' WHERE id = :id";
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute(['id' => $id])) {
        echo "Livreur validé avec succès !";
    } else {
        echo "Erreur lors de la validation.";
    }
} else {
    echo "Requête invalide.";
}
?>
