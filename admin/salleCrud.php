<?php
include '../session.php';
include '../connDB.php';
// Ajouter un projet
if (isset($_POST['ajoute'])) {
  $nom = $_POST['nom'];
  $capacite = $_POST['capacite'];
  $description = $_POST['description'];
  $status = $_POST['status'];
  $sql = "INSERT INTO salle (nom_salle, capacite, description,status) VALUES (?, ?, ?,?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$nom, $capacite, $description, $status]);
  if ($stmt) {
    echo "<script>alert('Salle ajouté avec succès.');
    window.location.href='listeSalle.php';
    </script>";
  } else {
    echo "<script>alert('Erreur lors de l\'ajout du salle.');</script>";
  }
}
// Modifier un projet
if (isset($_POST['Modifier'])) {
  $id = $_GET['updat'];
  $nom = $_POST['nom'];
  $capacite = $_POST['capacite'];
  $description = $_POST['description'];
  $status = $_POST['status'];
  $sql = "UPDATE salle SET nom_salle=?, capacite=?, description=?,status=? WHERE id=?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$nom, $capacite, $description, $status, $id]);

  if ($stmt) {
    echo "<script>alert('Salle Modifié avec succès.');
    window.location.href='listeSalle.php';
    </script>";
  } else {
    echo "<script>alert('Erreur lors de la modification du salle.');</script>";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Ajoute et Modifier</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    body {
      background-image: url('../images/R5.jpg');
      background-position: center;
      background-size: cover;
    }

    label {
      display: block;
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #333;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Barre de navigation -->
    <?php include('headerA.php'); ?>
    <div class="container">
      <div class="row">
        <?php
        if (isset($_GET["updat"])) {
          $id = $_GET['updat'];
          $sql = "SELECT * FROM salle WHERE id=?";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$id]);
          $row = $stmt->fetch();
          echo '<div class="container">
    <h2 class="text text-center text-warning">Modifier une salle</h2>
    <form method="post" action="" class="col-md-6 mx-auto">
        <div class="form-group">
            <label for="nom">Nom de la salle:</label>
            <input type="text" class="form-control" id="nom" name="nom" value="' . $row["nom_salle"] . '" required>
        </div>
        <div class="form-group">
            <label for="capacite">Capacité de la salle:</label>
            <input type="number" class="form-control" id="capacite" name="capacite" value="' . $row["capacite"] . '" required>
        </div>
        <div class="form-group">
            <label for="description">Description de la salle:</label>
            <textarea class="form-control" id="description" name="description" required>' . $row["description"] . '</textarea>
        </div>
        <div class="form-group">
            <label for="status">Statut de la salle:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="disponible" ' . ($row["status"] == "disponible" ? "selected" : "") . '>Disponible</option>
                <option value="occupee" ' . ($row["status"] == "occupee" ? "selected" : "") . '>Occupée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="Modifier">Modifier</button>
    </form>
</div>';
        } else {
          echo '<div class="container">
    <h2 class="text text-center text-warning">Ajout une salle</h2>
    <form method="post" action="" class="col-md-6 mx-auto">
        <div class="form-group">
            <label for="nom">Nom de la salle:</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="capacite">Capacité de la salle:</label>
            <input type="number" class="form-control" id="capacite" name="capacite" required>
        </div>
        <div class="form-group">
            <label for="description">Description de la salle:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="status">Statut de la salle:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="disponible">Disponible</option>
                <option value="occupee">Occupée</option>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" name="ajoute" value="Ajouter">
    </form>
</div>
      ';
        }
        ?>
      </div>
    </div>
    <!-- Scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNS8ZIh" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>&copy; 2023 Hospital Management System.</strong> All rights reserved.
  </footer>
</body>

</html>