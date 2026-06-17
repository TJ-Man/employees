<?php 
session_start();
include('fonction.php');
$recherche=getRecherche($_SESSION['departements'],$_SESSION['nom'],$_SESSION["min"],$_SESSION["max"],$_SESSION['limit']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <title>Resultat du Recherche</title>
</head>
<body>
    <div class="container my-3">
        <h1>Nom du departements : <?= $_SESSION['departements']?></h1>
        <table class="table table-bordered text-center" >
            <tr>
                <th>Numero</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date de Naissance</th>
                <th>Age </th>
            </tr>
        <?php foreach($recherche as $rech){?>
            <tr>
                <td><?= $rech['emp_no'] ?></td>
                <td><?= $rech['first_name']?></td>
                <td><?= $rech['last_name']?></td>
                <td><?= $rech['birth_date']?></td>
                <td><?= $rech['age']?></td>
            </tr>
            <?php } ?>
        </table>
        <div class="btn btn-primary">
               <a  class="nav-link" href="traitementformulaire.php?nombre=<?= $_SESSION['prec'] ?>">Predecent</a>
       </div>
        <div class="btn btn-primary">
               <a  class="nav-link" href="traitementformulaire.php?nombre=<?= $_SESSION['suiv'] ?>">Suivant</a>
       </div>
       <br>
       <br>
        
                
        <div class="btn btn-primary">
               <a class="nav-link" href="deconnexion.php">Retour</a>
           
       </div>
    </div>
    
</body>
</html>