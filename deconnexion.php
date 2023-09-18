<?php
  session_start();
  // Supprimer toutes les données de session
  session_unset();
  // Détruire la session
  session_destroy();
  // Rediriger l'utilisateur vers la page de connexion
  header('Location:home.php');
  exit;
?>