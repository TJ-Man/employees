<?php
include('fonction.php');
$salaire=getInfoSalaire();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
    <div class="container my-3">
    <table class="table table-bordered text-center">
        <tr>
            <td>Hommes</td>
            <td>Femmes</td>
            <td>Titre</td>
            <td>Salaire moyen</td>
        </tr>
        <tr>
        <?php    foreach($salaire as $sa){?>
            <td><?= $sa['hommes'];?></td>
            <td><?= $sa['femmes'];?></td>
            <td><?= $sa['title'];?></td>
            <td><?= $sa['salaire'];?></td>
        </tr>
    <?php } ?>
    </table>
    
            <div class="btn btn-primary">
               <a  class="nav-link" href="index.php">Retour</a>
       </div>
    </div>
</body>
</html>