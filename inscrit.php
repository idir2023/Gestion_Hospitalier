<?php
include 'connDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $photo = $_POST['photo'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $role = $_POST['role'];
    $sql = "SELECT COUNT(*) AS count FROM utilisateur WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result['count'] > 0) {
        echo "Cet utilisateur existe déjà.";
    } else {
        $sql = "INSERT INTO Utilisateur (email,mot_de_passe,role) VALUES (:email, :mot_de_passe, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':mot_de_passe', $mot_de_passe);
        $stmt->bindValue(':role', $role);
        $stmt->execute();
        $user_id = $pdo->lastInsertId(); // Récupérer l'ID de l'utilisateur inséré

        if ($role == 'patient') { 
            $sql = "INSERT INTO patient (nom_p, prenom_p, photo, id_user) VALUES (:nom, :prenom, :photo, :id_user)";
        } elseif ($role == 'medecin') {
            $sql = "INSERT INTO doctor (nom_d, prenom_d, photo, id_user) VALUES (:nom, :prenom, :photo, :id_user)";
        } elseif ($role == 'admin') {
            $sql = "INSERT INTO admin (nom, prenom, photo, id_user) VALUES (:nom, :prenom, :photo, :id_user)";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':photo', $photo);
        $stmt->bindValue(':id_user', $user_id);
        $stmt->execute();

        echo "<script> alert('Utilisateur inscrit avec succès.'); window.location.href='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Inscription</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <!-- custom css -->
    <link rel="stylesheet" href="css/main.css">
    <style>
        #contact {
            background-color: #007bff;
            padding: 100px;
        }

        .container.grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            align-items: center;
        }

        .contact-left img {
            width: 100%;
            max-width:800px;
            height: 650px;
            border: 0;
        }

        .contact-right {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .card-header {
            background-color: #dc3545;
            padding: 20px;
            border-radius: 5px;
        }

        .card-header h3 {
            margin:auto;
            color: #fff;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #000;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 5px;
            margin-bottom: 5px;
            border-radius: 10px;
            border: 3px solid #ddd;
        }

        #submit {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        #submit:hover {
            background-color: #0056b3;
        }

        #idir {
            color: blue;
            text-decoration: none;
        }

        .text-dark {
            color: #000;
        }

        .text-dark a {
            color: #007bff;
            text-decoration: none;
        }

        .text-dark a:hover {
            text-decoration: underline;
        }
        #p1{
            color: #000;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include 'header.php'; ?>
    <!-- Main content -->
    <section id="contact" class="contact py">
        <div class="container grid">
            <div class="contact-left">
                <img src="images/header.png" width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy"></img>
            </div>
            <div class="contact-right text-white text-center bg-blue">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-white text-center">
                            <h3 class="mt-3" style="display: block;">Inscription Utilisateurs</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="" onsubmit="return validateForm()">
                            <div class="form-group">
                                    <label for="photo">Photo:</label>
                                    <input type="file" class="form-control" id="photo" name="photo" >
                                </div>
                                <div class="form-group">
                                    <label for="nom">Nom:</label>
                                    <input type="text" class="form-control" id="nom" name="nom" >
                                </div>
                                <div class="form-group ">
                                    <label for="prenom">Prénom:</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" >
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" >
                                </div>
                                <div class="form-group">
                                    <label for="mot_de_passe">Mot de passe:</label>
                                    <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" >
                                </div>
                                <div class="form-group">
                                    <label for="confirmer_mot_de_passe">Confirmer le mot de passe:</label>
                                    <input type="password" class="form-control" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe" >
                                </div>
                                <div class="form-group">
                                    <label for="role">Rôle:</label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="user">Sélectionnez un rôle</option>
                                        <option value="admin">Administrateur</option>
                                        <option value="medecin">Médecin</option>
                                        <option value="patient">Patient</option>
                                    </select>
                                </div>
                                <div class="form-group" id="specialite_div" style="display: none;">
                                    <label for="specialite">Spécialité:</label>
                                    <input type="text" class="form-control" id="specialite" name="specialite">
                                </div>
                                <button type="submit" id="submit" name="submit" class="btn btn-danger"><i class="fas fa-user-plus"></i> S'inscrire</button>

                                <div class="text-center">
                                    <p id="p1">Si vous aves un compte <a href="login.php" id="idir">Register</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <!-- Ajout des scripts JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#role').on('change', function() {
                if (this.value === 'medecin') {
                    $('#specialite').show();
                } else {
                    $('#specialite').hide();
                }
            });
        });

        function validateForm() {
            var nom = document.getElementById("nom").value;
            var prenom = document.getElementById("prenom").value;
            var email = document.getElementById("email").value;
            var mot_de_passe = document.getElementById("mot_de_passe").value;
            var confirmer_mot_de_passe = document.getElementById("confirmer_mot_de_passe").value;
            var role = document.getElementById("role").value;

            if (nom == "" || prenom == "" || email == "" || mot_de_passe == "" || confirmer_mot_de_passe == "" || role == "") {
                alert("Veuillez remplir tous les champs.");
                return false;
            }

            if (mot_de_passe != confirmer_mot_de_passe) {
                alert("Les mots de passe ne correspondent pas.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>