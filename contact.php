<?php
// Inclure le fichier de connexion à la base de données
include 'connDB.php';

// Vérification de la soumission du formulaire
if (isset($_POST['Ajouter'])) {
    // Récupération des données du formulaire
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $id_salle = $_POST['id_salle'];
    $id_doctor = null;

    // Vérification de l'existence de l'id du docteur
    if (isset($_GET['id'])) {
        $id_doctor = $_GET['id'];
    }

    // Insertion du patient dans la base de données
    $sql = "INSERT INTO patient (nom_p, prenom_p) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom]);

    // Récupération de l'id du patient inséré
    $id_patient = $pdo->lastInsertId();

    // Insertion du rendez-vous dans la base de données
    $sql = "INSERT INTO rendez_vous (date, heure, id_patient, id_doctor, id_salle, status_rv) VALUES (?, ?, ?, ?, ?, 'En cours')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$date, $heure, $id_patient, $id_doctor, $id_salle]);

    // Affichage d'un message de succès
    echo "<script>alert('Rendez-vous enregistré avec succès!'); 
          window.location.href='home.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital</title>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- normalize css -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- custom css -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-- header -->
    <header class="header bg-blue">
        <?php include 'header.php'; ?>
        <section id="Rendez" class="contact py">
            <div class="container ">
                <div class="contact-right text-white text-center bg-blue">
                    <div class="contact-head">
                        <h3 class="lead">Rendez-vous</h3>
                    </div>
                    <form method="post" action="">
                        <div class="row">
                            <div class="form-element col-md-6">
                                <label for="Nom">Nom:</label>
                                <input type="text" class="form-control" id="Nom" name="nom" required>
                            </div>
                            <div class="form-element col-md-6">
                                <label for="Prenom">Prenom:</label>
                                <input type="text" class="form-control" id="Prenom" name="prenom" required>
                            </div>
                        </div>

                        <!-- Remplacez "contact.php" par le nom de votre script de traitement PHP -->
                        <div class="form-element">
                            <label for="date">Date :</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-element">
                            <label for="heure">Heure :</label>
                            <input type="time" class="form-control" id="heure" name="heure" required>
                        </div>
                        <div class="form-element">
                            <label for="id_salle">Salle :</label>
                            <select class="form-control" id="id_salle" name="id_salle" required>
                                <option value="">Sélectionner une salle</option>
                                <?php
                                // Requête pour récupérer les salles
                                $sql = "SELECT id, nom_salle FROM salle";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute();
                                // Boucle sur les résultats de la requête pour créer des options
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['nom_salle'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="Ajouter" class="btn btn-white btn-submit">
                            <i class="fas fa-arrow-right"></i> Prendre Rendez-vous
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <?php include 'footer.php'; ?>
        <!-- custom js -->
        <script src="js/script.js"></script>
</body>

</html>