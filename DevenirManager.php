<?php
include('fonction.php');

if (isset($_GET['num'])) {
    $id = $_GET['num'];
} else {
    $id = null;
}

if (!$id) {
    die("Numero d'employe manquant.");
}

$employe = getInfoEmployee($id);
if (empty($employe)) {
    die("Employe introuvable.");
}
$employe = $employe[0];

$dept = getDeptActuel($id);
if (!$dept) {
    die("Cet employe n'a pas de departement actuel.");
}
$dept_no = $dept['dept_no'];

$managerActuel = getManagerActuel($dept_no);

$erreur = '';
$succes = false;

if (isset($_POST['valider'])) {
    
    if (isset($_POST['from_date'])) {
        $dateDebut = $_POST['from_date'];
    } else {
        $dateDebut = '';
    }

    if (empty($dateDebut)) {
        $erreur = "Veuillez saisir une date de debut.";
    } else if ($managerActuel && $managerActuel['emp_no'] == $id) {
        $erreur = "Cet employe est deja le manager actuel de ce departement.";
    } else if ($managerActuel && $dateDebut < $managerActuel['from_date']) {
        $erreur = "La date de debut (" . $dateDebut . ") ne peut pas etre anterieure "
                . "a la date de debut du manager actuel (" . $managerActuel['from_date'] . ").";
    } else {
        
        if ($managerActuel) {
            $ancienId = $managerActuel['emp_no'];
        } else {
            $ancienId = null;
        }
        
        $ok = setNouveauManager($dept_no, $ancienId, $id, $dateDebut);
        if ($ok) {
            $succes = true;
            $managerActuel = getManagerActuel($dept_no);
        } else {
            $erreur = "Une erreur est survenue lors de la mise a jour.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body>
    <div class="container my-3">

        <h2>Devenir manager du departement <?= $dept['dept_name'] ?> (<?= $dept_no ?>)</h2>

        <?php if ($managerActuel) { ?>
            <p>
                Manager actuel : <strong><?= $managerActuel['first_name'] . ' ' . $managerActuel['last_name'] ?></strong>
                (depuis le <?= $managerActuel['from_date'] ?>)
            </p>
        <?php } else { ?>
            <p>Aucun manager actuel pour ce departement.</p>
        <?php } ?>

        <?php if ($erreur) { ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php } ?>

        <?php if ($succes) { ?>
            <div class="alert alert-success">
                <?= $employe['first_name'] . ' ' . $employe['last_name'] ?>
                est maintenant le manager du departement <?= $dept_no ?>.
            </div>
        <?php } else { ?>
            <form method="post" action="DevenirManager.php?num=<?= $id ?>">
                <div class="mb-3">
                    <label for="from_date" class="form-label">Date de debut</label>
                    <input type="date" class="form-control" id="from_date" name="from_date" required>
                </div>
                <button type="submit" name="valider" class="btn btn-success">Valider</button>
            </form>
        <?php } ?>

        <br>
        <div class="btn btn-primary">
            <a class="nav-link" href="index.php?num=<?= $id ?>">Retour</a>
        </div>

    </div>
</body>
</html>