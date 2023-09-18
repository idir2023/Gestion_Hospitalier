<?php include 'sessionP.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Liste des dossiers médicaux</title>
	<!-- Lien CSS pour la mise en forme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		.container {
			max-width: 500px;
			margin: 0 auto;
			padding: 20px;
		}

		.dossier-medical {
			border: 1px solid #ddd;
            border-radius: 16px;
            width: 70%;
            margin: auto;
			padding: 10px;
			margin-bottom: 10px;
			background-color: blanchedalmond;
		}
        h4{
            text-align: center;
        }
		.dossier-medical h3 {
			margin-top: 0;
		}

		.dossier-medical p {
			margin-bottom: 0;
		}
	</style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barre de navigation -->
        <?php include('headerC.php'); ?>
        <div class="container">
            <?php
            include_once('../connDB.php');
            $id_dossier= $_SESSION['user_id'] ;
            // Requête SQL pour récupérer les dossiers médicaux
            $sql = "SELECT * FROM dossiers_medicaux,patient,doctor
            where dossiers_medicaux.id_patient=patient.id and
            dossiers_medicaux.id_doctor=doctor.id and patient.id_user=' $id_dossier'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Afficher les dossiers médicaux dans la page
            if (count($result) > 0) {
                foreach ($result as $row) {
                    echo '<div class="dossier-medical">';
                    echo '<h4>Nom du patient :' . $row['nom_p'] .' '. $row['prenom_p']. '</h4>';
                    echo '<p><h5>Médecin traitant :</h5> ' . $row['nom_d'] .' '. $row['prenom_d'].  '</p>';
                    echo '<p><h5>Date : </h5>' . $row['date'] . '</p>';
                    echo '<p><h5>Diagnostic :</h5> ' . $row['diagnostic'] . '</p>';
                    echo '<p><h5>Traitement :</h5> ' . $row['traitement'] . '</p>';
                    echo '</div>';?>
                    <div style="text-align: center;">
                        <button class="btn btn-primary" onclick="imprimerDossiersMedicaux()">Imprimer</button>
                    </div>
               <?php }
            } else {
                echo '<p>Aucun dossier médical trouvé.</p>';
            }
            // Fermer la connexion à la base de données
            $conn = null;
            ?>
           
        </div>
    <script>
        function imprimerDossiersMedicaux() {
            window.print();
        }
    </script>
    <!-- Ajouter les liens vers les fichiers JavaScript de Bootstrap ici -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
    </footer>
</body>
</html>
