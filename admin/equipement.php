<?php
include '../session.php';
// Connexion à la base de données avec PDO
include '../connDB.php';

// Vérifier si le formulaire a été soumis
if (isset($_POST['Ajouter'])) {
    // Récupérer les valeurs du formulaire
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $emplacement = $_POST['emplacement'];
    $etat = $_POST['etat'];
    $photo = $_POST['photo'];
    // Requête d'insertion dans la table 'equipements_medicaux' avec des paramètres préparés
    $sql = "INSERT INTO equipements_medicaux (nom, description, emplacement, etat,photo) VALUES (?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($nom, $description, $emplacement, $etat, $photo));
    if ($stmt) {
        // Afficher une alerte Bootstrap pour indiquer que l'ajout a réussi
        echo '<script>alert("L\'équipement médical a été ajouté avec succès."); window.location.href="listeEquipement.php";</script>';
    }

    // Fermer la connexion à la base de données
    $pdo = null;
}
if (isset($_POST['Modifier'])) {
    // Récupérer les valeurs du formulaire
    $id = $_GET['id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $emplacement = $_POST['emplacement'];
    $etat = $_POST['etat'];
    $photo = $_POST['photo'];

    // Requête de mise à jour dans la table 'equipements_medicaux'
    $sql = "UPDATE equipements_medicaux SET nom =?, description = ?, emplacement = ?, etat = ? ,photo=? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($nom, $description, $emplacement, $etat, $photo, $id));
    if ($stmt) {
        // Afficher une alerte Bootstrap pour indiquer que la modification a réussi
        echo '<script>alert("L\'équipement médical a été Modifié avec succès."); window.location.href="listeEquipement.php";</script>';
    }
    // Fermer la connexion à la base de données
    $pdo = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Modifier / Ajouter une Ressource Médicale</title>
    <!-- Lien vers le fichier CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
.doctor-card img {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 30%;
  margin-bottom: 5px;
}
</style>
</head>

<body class="">
    <div class="wrapper">
        <!-- Barre de navigation -->
        <?php include('headerA.php'); ?>
        <div class="container">
            <?php
            include '../connDB.php';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                // Requête SQL pour récupérer les ressources médicales
                $sql = "SELECT * FROM equipements_medicaux where id=$id";
                $result = $pdo->prepare($sql);
                $result->execute();
                $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
                <h4 class="text text-center text-primary">Modifier une Ressource Médicale</h4>
                <form method="post" action=""> <!-- Formulaire pour la modification / ajout de ressource médicale -->
                    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>"> <!-- Champ caché pour stocker l'ID de la ressource médicale -->
                    <div class="form-group ">
                        <label for="nom">Photo</label>
                        <div class="doctor-card">
                            <img src="../images/<?php echo $row['photo']; ?>" alt="Photo de profil">
                        </div>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                    <div class="form-group ">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo isset($row['nom']) ? $row['nom'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required><?php echo isset($row['description']) ? $row['description'] : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="emplacement">Emplacement</label>
                        <input type="text" class="form-control" id="emplacement" name="emplacement" value="<?php echo isset($row['emplacement']) ? $row['emplacement'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="etat">État</label>
                        <select class="form-control" id="etat" name="etat" required>
                            <option value="Disponible" <?php echo isset($row['etat']) && $row['etat'] == 'Disponible' ? 'selected' : ''; ?>>Disponible</option>
                            <option value="En cours de maintenance" <?php echo isset($row['etat']) && $row['etat'] == 'En cours de maintenance' ? 'selected' : ''; ?>>En cours de maintenance</option>
                            <option value="Hors service" <?php echo isset($row['etat']) && $row['etat'] == 'Hors service' ? 'selected' : ''; ?>>Hors service</option>
                        </select>
                    </div>
                    <button type="submit" name="Modifier" class="btn btn-primary">Modifier</button>
                </form>

            <?php } else { ?>
                <h4 class="text text-center text-primary">Ajouter une Ressource Médicale</h4>
                <form method="post" action=""> <!-- Formulaire pour la modification / ajout de ressource médicale -->
                    <input type="hidden" name="id"> <!-- Champ caché pour stocker l'ID de la ressource médicale -->
                    <div class="form-group ">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                    <div class="form-group ">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="emplacement">Emplacement</label>
                        <input type="text" class="form-control" id="emplacement" name="emplacement">
                    </div>
                    <div class="form-group">
                        <label for="etat">État</label>
                        <select class="form-control" id="etat" name="etat" required>
                            <option value="Disponible">Disponible</option>
                            <option value="En cours de maintenance">En cours de maintenance</option>
                            <option value="Hors service">Hors service</option>
                        </select>
                    </div>
                    <button type="submit" name="Ajouter" class="btn btn-primary">Ajouter</button>
                </form>
            <?php } ?>
        </div>
        <!-- Scripts JavaScript requis pour le fonctionnement de Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
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