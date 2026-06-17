<?php
include('fonction.php');

$id = $_POST['emp_no'];
$depart = $_POST['departements'];
$date_debut = $_POST['date_debut'];
$current_from_date = $_POST['current_from_date'];
if ($date_debut < $current_from_date) {

    header("Location: changerdepart.php?num=" . $id . "&error=1");
    exit();
}
$verif = modifierDepartementEmployee($id, $depart, $date_debut);
if ($verif == true) {
    header("Location: infoEmployee.php?num=" . $id);
    exit();
} else {
    echo "Une erreur est survenue lors de la mise à jour.";
}
?>