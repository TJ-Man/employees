#T.J(ETU004975) ET MIRADO (ETU004667)
##-index.php
    -affichage
        -(ok)liste de departements avec manager
        -(ok)rechercher
        -(ok)ajout du colonne nombre d'employee
        -(ok)ajout du bouton information salaire par emploi
        -(ok)bootstrap
    -base
    -fonction
        -(ok)getDepartements()
    -code dynamique
        -(ok)foreach

##-infodepart.php
    -affichage
        -(ok)Employees dans le departements(num,nom,prenom,to_date) limit 20
        -(ok)btn precedent
        -(ok)btn suivant
        -(ok)btn retour
    -base
    -fonction
        -(ok)getInfoDepartements()
    -code dynamique
        -(ok)foreach

##-infoEmployee.php
    -affichage
        -(ok)fiche complet de l employee
        -(ok)Histoque du salaire
        -(ok)btnchanger de departements
        -(ok) btn devenir Manager
    -base
    -fonction
        -(ok)getInfoEmployee
        -(ok)getHistoriqueSalaire
        -(ok)getEmployelepluslong
    -code dynamique
        -(ok)foreach
##-formulaire.php
    -affichage
        -(ok)Affichage de resultat de recherche
        -(ok)btn Precedent
        -(ok)Suivant
        -(ok)btn Retour
    -fonction
        -(ok)getRecherche

##-traitementformulaire.php
##-deconnexion.php
    -affichage
        -(ok)session start + session destroy
##-changerdepart.php
    -affichage
        -(ok)Message d erreur
        -(ok) DEpartement actuel + date de debut
        -(ok)formulaire post
        -(ok) liste deroulente de tous les departements sauf le departement actuel
        -(ok) input nouveau date
        -(ok)btn valider
    -fonction.php
        -(ok)getNomDepart()
        -(ok)getDepartementActuel
##-traitementchangement.php
    -fonction
        -(ok)modifierDepartementEmployee
##-Devenir Manager
    -affichage
        -(ok)en haut du formulaire le nom du manager en cours
        -(ok)un message de d'erreur si la date de début du nouveau manager est antérieur à la date du début de l'actuel
    -fonction
        -(ok)getInfoEmployee
        -(ok)detDeptActuel
        -(ok)getManagerActuel
        -(ok)setNouveauManager
##-infoSalaire
    -affichage
        -(ok)Salaire Moyen d un emploi
        -(ok)nbr homme et femmes
        -(ok)btn retour
    -fonction
        -(ok)getInfoSalaire
    