document.addEventListener("DOMContentLoaded", function() {
    // ✅ Fonction pour ajouter un livreur
    document.getElementById("addLivreurForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        let nom = document.getElementById("nom").value;
        let email = document.getElementById("email").value;
        let telephone = document.getElementById("telephone").value;

        fetch("add_livreur.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `nom=${nom}&email=${email}&telephone=${telephone}`
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById("message").innerHTML = `<div class="alert alert-info">${data}</div>`;
            setTimeout(() => location.reload(), 1500); // Rafraîchit la page après 1,5 sec
        });
    });

    // ✅ Bouton "Valider"
    document.querySelectorAll(".valider-btn").forEach(button => {
        button.addEventListener("click", function() {
            let id = this.getAttribute("data-id");

            fetch("valider.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${id}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            });
        });
    });

    // ✅ Bouton "Supprimer"
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let id = this.getAttribute("data-id");

            if (confirm("Voulez-vous vraiment supprimer ce livreur ?")) {
                fetch("supprimer.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `id=${id}`
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload();
                });
            }
        });
    });

    // ✅ Bouton "Noter"
    document.querySelectorAll(".noter-btn").forEach(button => {
        button.addEventListener("click", function() {
            let id = this.getAttribute("data-id");
            let note = prompt("Attribuer une note (0-5) :");
    
            if (note !== null && !isNaN(note) && note >= 0 && note <= 5) {
                fetch("noter.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `id=${id}&note=${note}`
                })
                .then(response => response.json())  // Décoder la réponse JSON
                .then(data => {
                    alert(data.message);  // Afficher le message proprement
                    location.reload();  // Rafraîchir la page pour voir la mise à jour
                })
                .catch(error => alert("Erreur lors de la requête."));
            } else {
                alert("Veuillez entrer une note valide entre 0 et 5.");
            }
        });
    });
    
    
        });
