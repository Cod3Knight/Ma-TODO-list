<?php
require_once('con_bdd.php');

function test_input($data) {
     
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    $firstname = test_input($_POST["firstname"]);
    $password = test_input($_POST["password"]);
    $stmt = $con->prepare("SELECT * FROM users");
    $stmt->execute();
    $resultSet = $stmt->get_result();
    $result = $resultSet->fetch_all();
     
    // IL ME MANQUE DES DONNEES ET CERTAINES ICI SONT ERRONNEES 
    {
         
        if(($user['firstname'] == $firstname) &&
            ($user['password'] == $password)) {
                header("location: exo alex\index.php");
             
        }
        else {
            echo "<script language='javascript'>";
            echo "alert('Retapez votre EMAIL ou votre PASSWORD !')";
            echo "</script>";
            die();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire connection TODO</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time();?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>
    <div class="bbb">
        
    <h3><strong>Formulaire connection - TODO -</strong></h3>

    <form class="container" action="" method="post">

        <div class="mb-3">
            <label for="firstname" class="form-label"><strong>PRENOM</strong></label>
            <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Entrez votre Prenom">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><strong>PASSWORD</strong></label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Entrez votre Mot de Passe">
        </div>
        <button type="submit" class="btn btn-primary" name="validate"><strong>Se connecter</strong></button>
        <br><br>

    </form>

    <?php /* Pop-up succès ou error message */
    if(isset($success)) {
        echo "<div class='success'>{$success}</div>";
        echo "<script>setTimeout(()=>{document.getElementsByClassName('success')[0].style.display ='none';},2000)</script> ";
    }
    if(isset($error)) {
        echo "<div class='error'>{$error}</div>";
        echo "<script>setTimeout(()=>{document.getElementsByClassName('error')[0].style.display ='none';},8000)</script> ";
    }
    ?>

    </div>
</body>

</html>