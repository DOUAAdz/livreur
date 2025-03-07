<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["note"])) {
    $id = intval($_POST["id"]);
    $note = floatval($_POST["note"]);

    // Vérifier que la note est entre 0 et 5
    if ($note < 0 || $note > 5) {
        echo json_encode(["status" => "error", "message" => "Note invalide !"]);
        exit;
    }

    try {
        // Vérifier si le livreur existe
        $checkSql = "SELECT note FROM livreurs WHERE id = :id";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->execute(['id' => $id]);
        $livreur = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if (!$livreur) {
            echo json_encode(["status" => "error", "message" => "Livreur non trouvé."]);
            exit;
        }

        // Mettre à jour la note du livreur
        $sql = "UPDATE livreurs SET note = :note WHERE id = :id";
        $stmt = $conn->prepare($sql);
        
        if ($stmt->execute(['note' => $note, 'id' => $id])) {
            echo json_encode(["status" => "success", "message" => "Note attribuée avec succès !"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Erreur lors de la mise à jour de la note."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Erreur SQL : " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Requête invalide."]);
}
?>
