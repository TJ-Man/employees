<?php
include('fonction.php');
$id = $_GET['num']; 
$liste_depart = getNomDepart();
$actuel = getDepartementActuel($id); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer de département</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body>
    <div class="container my-3">
        
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger">
                Erreur : entrez une nouvelle date.
            </div>
        <?php } ?>

        <div class="alert alert-info">
            <h5>Département actuel : <?= $actuel['dept_name'] ?></h5>
            <p class="mb-0">Depuis le : <?= $actuel['from_date'] ?></p>
        </div>

        <form action="traitementchangement.php" method="post">
            <input type="hidden" name="emp_no" value="<?= $id ?>">
            <input type="hidden" name="current_from_date" value="<?= $actuel['from_date'] ?>">

            <h2>Changer de départements</h2>
            <select name="departements" class="form-select mb-3">
                <?php foreach ($liste_depart as $ld) {
                    if ($ld['dept_name'] != $actuel['dept_name']) { ?>
                        <option value="<?= $ld['dept_no'] ?>"><?= $ld['dept_name'] ?></option>
                    <?php } 
                } ?>
            </select>

            <h2>Date de début</h2>
            <input type="date" name="date_debut" class="form-control" required>
            <br>
            <br>
            
            <input type="submit" class="btn btn-primary" value="Valider">
            <a href="infoEmployee.php?num=<?= $id ?>" class="btn btn-secondary">Annuler</a>
        </form>

    </div>
</body>
</html>