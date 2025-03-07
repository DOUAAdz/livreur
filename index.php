<?php
include "connection.php";

// Assure-toi que $conn est bien défini
$conn = $GLOBALS['conn'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Livreurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container my-4">
    <h2 class="text-center">Liste des livreurs</h2>

    <!-- Formulaire d'ajout -->
    <div class="card p-3 mb-4 shadow">
        <h4> Ajouter un livreur</h4>
        <form id="addLivreurForm">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" id="nom" class="form-control" placeholder="Nom" required>
                </div>
                <div class="col-md-3">
                    <input type="email" id="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-3">
                    <input type="text" id="telephone" class="form-control" placeholder="Téléphone" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Ajouter</button>
                </div>
            </div>
        </form>
        <div id="message" class="mt-2"></div>
    </div>

    <!--  Tableau des livreurs -->
    <table class="table table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Statut</th>
                <th>Note Moyenne</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="livreursTable">
            <?php
            $sql = "SELECT * FROM livreurs ORDER BY id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                echo "
                <tr id='row_{$row['id']}'>
                    <td>{$row['id']}</td>
                    <td>{$row['nom']}</td>
                    <td>{$row['email']}</td> <!-- Correction ici -->

                    <td>{$row['telephone']}</td>
                    <td><span class='badge bg-".($row['statut'] == 'Validé' ? "success" : "warning")."'>{$row['statut']}</span></td>
                    <td>" . (!empty($row['note']) ? "{$row['note']} / 5" : "Pas encore noté") . "</td>
                    <td>
                        <button class='btn btn-success btn-sm valider-btn' data-id='{$row['id']}'> Valider</button>
                        <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}'>Supprimer</button>
                        <button class='btn btn-primary btn-sm noter-btn' data-id='{$row['id']}'>⭐ Noter</button>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
