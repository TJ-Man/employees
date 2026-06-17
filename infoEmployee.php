<?php
include('fonction.php');
$id=$_GET['num'];
$info =getInfoEmployee($id);
$histo = getHistoriqueSalaire($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info-Employees</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body>
    <div class="container my-3">
        <table class="table table-bordered text-center" >
            <tr>
                <th>emp_no</th>
                <th>birth_date</th>
                <th>first_name</th>
                <th>last_name</th>
                <th>gender</th>
                <th>hire_date </th>
            </tr>
        <?php foreach($info as $depart){?>
            <tr>
                <td><?= $id ?></td>
                <td><?= $depart['first_name']?></td>
                <td><?= $depart['last_name']?></td>
                <td><?= $depart['gender']?></td>
                <td><?= $depart['birth_date']?></td>
                <td><?= $depart['hire_date']?></td>
            </tr>
                
        <?php } ?>
                
        </table>
        <h2>Historique du salaire</h2>
        <table class="table table-bordered text-center" >
            <tr>
                <th>Numero</th>
                <th>Salaire</th>
                <th>From_Date</th>
                <th>To_Date</th>
                <th>Poste</th>
            </tr>
        <?php foreach($histo as $h){?>
            <tr>
                <td><?= $h['emp_no'] ?></td>
                <td><?= $h['salary']?></td>
                <td><?= $h['from_date']?></td>
                <td><?= $h['to_date']?></td>
                <td><?= $h['title']?></td>

            </tr>
                
        <?php } ?>
                
        </table>


        <div class="btn btn-primary">
            <a class="nav-link" href="index.php">Retour</a>
        </div>
    </div>
    
</body>
</html>