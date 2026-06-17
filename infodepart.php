<?php
include('fonction.php');
$id=$_GET['num'];
$limit=$_GET['nombre'] ?? 0;
$suiv=20+$limit;
$prec=$limit-20;
if($prec<0){
    $prec =0;

}
$info =getInfoDepartements($id,$limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body>
    <div class="container my-3">
        <table class="table table-bordered text-center" >
            <tr>
                <th>Numero Employees</th>
                <th>First_Name</th>
                <th>From_Date</th>
                <th>TO_DATE</th>
            </tr>
        <?php foreach($info as $depart){?>
            <tr>
                    <td><a class="nav-link" href="infoEmployee.php?num=<?= $depart['emp_no']?>"><?= $depart['emp_no']?></a></td>
                    <td><?= $depart['first_name']; ?></td>
                    <td><?= $depart['from_date'];?></td>
                    <td><?= $depart['to_date'];?></td>
                    
                </tr>
                
        <?php } ?>
                
        </table>
        <div class="btn btn-primary">
               <a  class="nav-link" href="infodepart.php?nombre=<?= $prec ?>&&num=<?= $id?>">Predecent</a>
       </div>
        <div class="btn btn-primary">
               <a  class="nav-link" href="infodepart.php?nombre=<?= $suiv?>&&num=<?= $id?>">Suivant</a>
       </div>
       <br>
       <br>
        <div class="btn btn-primary">
               <a  class="nav-link" href="index.php">Retour</a>
       </div>


    </div>
    
</body>
</html>