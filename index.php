<?php
include('fonction.php');
$departements =getDepartements();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <title>Liste departements</title>
</head>
<body>
    <div class="container my-3">
        <table  class="table table-bordered text-center">
             <h1 class="text-center">Recherche</h1>
            <form action="traitementformulaire.php" method="post">
                <h2>Departements</h2>
                <input type="text" name="departements" >
                <h2>Nom employees</h2>
                <input type="text" name='nom'>
                <h2>Age</h2>
                <h5>Min</h5>
                <input type="number" name="min" value="0">
                <h5>Max</h5>
                <input type="number" name="max" value='100'>
                <br>
                <br>
                <input type="submit" value="Rechercher">
            </form>
        </table>

        <h1>Liste des departements</h1>
        <table class="table table-bordered text-center">
            <tr>
                <td>Numero departements</td>
                <td>Nom departements  </td>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Nomdre d'employers</td>
            </tr>
            <?php foreach($departements as $depart){?>
                <tr>
                    <td><a class="nav-link" href="infodepart.php?num=<?= $depart['dept_no']?>"><?= $depart['dept_no']?></a></td>
                    <td><?= $depart['dept_name']?></td>
                    <td><?= $depart['first_name']?></td>
                    <td><?= $depart['last_name']?></td>
                    <td><?= $depart['nb_emp']; ?></td>
                </tr>
                
                <?php } ?>
            </table>
                    <div class="btn btn-primary">
               <a  class="nav-link" href="InfoSalaire.php">Informations des salaires par emploi</a>
       </div>

            
    </div>
</body>
</html>