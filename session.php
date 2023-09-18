
<?php
  session_start();
  require_once 'connDB.php';
  
  if (!isset($_SESSION['user_id']) || !isset($_SESSION['email']) || !isset($_SESSION['user_role'])) {
    echo "<script>alert('Vous ne êtes pas encore connecté');
    window.location='../login.php';
    </script>";
    exit;
  }
  $user_id = $_SESSION['user_id'];
  $email = $_SESSION['email'];
  $exist = $pdo->prepare("SELECT * FROM utilisateur WHERE id= ?");
  $exist->execute([$user_id]);
  $user = $exist->fetch(PDO::FETCH_ASSOC);
  
  if (!$user || $user['email'] !== $email || $user['role'] !=='admin') {
    echo "<script>alert('Vous ne êtes pas encore connecté');
    window.location='../login.php';
    </script>";
    exit;
  }
?>
