<?php
session_start();
/**
 * co_db : connexion à la base de donnée 
 *
 * @return PDO
 */
function co_db(): PDO
{
    $pdo = new PDO('mysql:host=localhost;dbname=bonheur-enfants', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
}

/**
 * connexion_admin : connexuon pour l'administrateur du système
 *
 * @param mixed $email
 * @param mixed $password
 * @return int
 */
function connexion_admin($identifiant, $password)
{
    $SQL_Connexion = co_db()->query("SELECT *  FROM parametres WHERE email = '$identifiant' AND mot_passe = '$password'") or die('Erreur de la requête SQL');
    $total = $SQL_Connexion->rowCount();

    if ($total != 0 and $total = 1) {
        $_SESSION['madame-Diop'] = $_POST['identifiant'];
        header('Location:../index.php?p=dashbord');
    } else {
        header('Location:/');
    }
}

/**
 * AjoutClasses : Ajouter une claase
 *
 * @param  mixed $nom
 */
function ajoutUneLigne($nom, $table, $champ)
{
    if (!empty($nom) and strlen($nom) > 3) {
        $insert_donnees = co_db()->prepare("INSERT INTO $table($champ) VALUES (?)");
        $insert_donnees->execute(array($nom));
        return header('Location:../index.php?p=' . $table);
    }
}

/**
 * fonction permettant d'ajouter un classe
 *
 * @param string $section
 * @param integer $montant_inscription
 * @param integer $montant_mensuel
 * @param integer $effectif
 * @return void
 */
function ajoutSection(string $section, int $montant_inscription, int $montant_mensuel, int $effectif)
{
    $insert_donnees = co_db()->prepare("INSERT INTO sections(section, montant_inscription, montant_mensuel, effectif) VALUES (?, ?, ?, ?)");
    $insert_donnees->execute(array($section, $montant_inscription, $montant_mensuel, $effectif));
    return header('Location:../index.php?p=enseignement');
}

function insert_cles_etrangere(int $id_1, int $id_2, $champ_1, $champ_2, string $table)
{
    if (co_db()->query("SELECT * FROM $table WHERE $champ_1 = '$id_1' AND $champ_2 = '$id_2'")->rowCount() == 0) {
        $insert_donnees = co_db()->prepare("INSERT INTO $table($champ_1, $champ_2) VALUES (?, ?)");
        $insert_donnees->execute(array($id_1, $id_2));
        return header('Location:../index.php?p=enseignement&s=1');
    } else {
        return header('Location:../index.php?p=enseignement&s=0');
    }
}
/**
 * Undocumented function
 *
 * @param [type] $champ_1
 * @param [type] $champ_2
 * @param [type] $champ_3
 * @return void
 */
function cles_etrangere_enseigner($champ_1, $champ_2, $champ_3)
{
    if (!empty($champ_1) and !empty($champ_2)) {

        $section_id = identifiantUneLigne("sections", "identifiant", "section", $champ_1);
        $matiere_id = identifiantUneLigne("matieres", "identifiant", "nom", $champ_2);
        $enseignant_id = identifiantUneLigne("enseignants", "identifiant", "nom", $champ_3);

        if (co_db()->query("SELECT * FROM enseigner WHERE section_id = $section_id AND matiere_id = $matiere_id AND enseignant_id = $enseignant_id")->rowCount() == 0) {
            $insert_donnees = co_db()->prepare("INSERT INTO enseigner(section_id, matiere_id, enseignant_id) VALUES (?, ?, ?)");
            $insert_donnees->execute(array($section_id, $matiere_id, $enseignant_id));
            return header('Location:../index.php?p=enseignement&s=1');
        } else {
            return header('Location:../index.php?p=enseignement&s=0');
        }

        insert_cles_etrangere($section_id, $matiere_id, $enseignant_id, "section_id", "matiere_id", "enseigner");
    }
}
/**
 *
 * @param string $champ_1
 * @param string $champ_2
 * @return void
 */
function cles_etrangere_dispenser(string $champ_1, string $champ_2)
{
    if (!empty($champ_1) and !empty($champ_2)) {
        $enseignant_id = identifiantUneLigne("enseignants", "identifiant", "nom", $champ_1);
        $matiere_id = identifiantUneLigne("matieres", "identifiant", "nom", $champ_2);
        insert_cles_etrangere($enseignant_id, $matiere_id, 'enseignant_id', 'matiere_id', "dispenser");
    }
}

function enseignement(int $section_id)
{
    $SQL = co_db()->query("SELECT matieres.nom, sections.section, enseignants.nom AS nom_e
        FROM matieres, sections, enseigner, enseignants
        WHERE matieres.identifiant = enseigner.matiere_id 
        AND sections.identifiant = $section_id
        AND enseignants.identifiant = enseigner.enseignant_id
        AND sections.identifiant = enseigner.section_id");

    return $SQL->fetchAll();
}
/**
 * Undocumented function
 *
 * @param [string] $table
 * @return integer
 */
function nombre_ligne(string $table, $id): int
{
    return (int) co_db()->query("SELECT COUNT($id) FROM $table")->fetch(PDO::FETCH_NUM)[0];
}

function ligne_existe(string $table, int $id, $champ)
{
    return (int) co_db()->query("SELECT COUNT($id) FROM $table WHERE $champ = '$id'")->fetch(PDO::FETCH_NUM)[0];
}

/**
 * selection : retourne toutes les classes de 
 *
 * @return array
 */
function toutesLigne(string $table): array
{
    $SQL_Connexion = co_db()->query("SELECT * FROM $table");
    return $SQL_Connexion->fetchAll();
}

function identifiantUneLigne(string $table, $selection, string $champ, $condition)
{
    $SQL = co_db()->query("SELECT $selection FROM $table WHERE $champ = '$condition'");
    return $SQL->fetch()['identifiant'];
}

function uneLigne(string $table, string $champ, $condition)
{
    $sql = co_db()->query("SELECT * FROM $table WHERE $champ = '$condition'");
    return $sql->fetch();
}

function id_parent(string $nom, string $prenom)
{
    $SQL_Connexion = co_db()->query("SELECT identifiant FROM parents WHERE nom = '$nom' AND prenom = '$prenom'");
    if ($SQL_Connexion->rowCount() == 1) {
        return $SQL_Connexion->fetch()['identifiant'];
    } else {
        return '';
    }
}
/**
 * suppression_element_id_en_get
 *
 * @param  mixed $identifiant
 * @param  mixed $table
 * @return void
 */
function suppression_element_id_en_get(int $identifiant, $champ, string $table)
{
    // var_dump($identifiant);

    if (!empty($identifiant)) {
        $suppression_donnees = co_db()->prepare("DELETE FROM $table  WHERE $champ = ?");
        if ($suppression_donnees->execute(array($identifiant))) {
            return header('Location:../index.php?p=classes');
        }
    }
}

/**
 * modificationSession : Modification de la classe 
 *
 * @param  mixed $session
 * @return string
 */
function modifierClasse($section, $identifiant)
{
    if (co_db()->query("UPDATE sections SET section = '$section' WHERE identifiant = '$identifiant' ")) {
        return header('Location:../index.php?p=classes');
    }
}



function ajoutEleves(string $nom_e, string $date_naissance, string $religion, string $emprinte, bool $malade, string $symptome, bool $ecole, string $infos_ecole, string $section_id, string $nom_r, string $telephone, string $email, string $profession, string $adresse, string $motif, string $lien, string $engagement)
{
    $matricule = generation_matricule($nom_e, $nom_r);

    // string $matricule

    $section_id = identifiantUneLigne("sections", "identifiant", "section", $section_id);

    if ($malade === "Oui") {
        $malade = 1;
    } else {
        $malade = 0;
    }
    if ($ecole === "Oui") {
        $ecole = 1;
    } else {
        $ecole = 0;
    }

    $insert_donnees = co_db()->prepare("INSERT INTO eleves(matricule, nom_e, date_naissance, religion, emprinte, malade, symptome, ecole, infos_ecole, section_id, nom_r, telephone, email, profession, adresse, motif, lien, engagement)
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $reponse = $insert_donnees->execute(array($matricule, $nom_e, $date_naissance, $religion, $emprinte, $malade, $symptome, $ecole, $infos_ecole, $section_id, $nom_r, $telephone, $email, $profession, $adresse, $motif, $lien, $engagement));

    if ($reponse) {
        return header('Location:../index.php?p=eleves&m=1');
    }
    return $reponse;
}

function ajoutEnseignant(string $nom, string $telephone, string $email, string $residence)
{
    $insert_donnees = co_db()->prepare("INSERT INTO enseignants(nom, telephone, email, residence)
    VALUES (?, ?, ?, ?)");
    if ($insert_donnees->execute(array($nom, $telephone, $email, $residence))) {
        return header('Location:../index.php?p=enseignement&m=1');
    } else {
        return header('Location:../index.php?p=enseignement&m=0');
    }
}

/**
 * generation_matricule : génération de matricule 
 *
 * @param  mixed $nom
 * @param  mixed $prenom
 * @param  mixed $autre
 * @return string
 */
function generation_matricule($nom, $prenom): string
{
    $nom = strtoupper(substr($nom, 0, 2));
    $prenom = strtoupper(substr($prenom, 0, 2));
    return "ABE-" . $nom . "-" . $prenom;
}


function ajoutResultat()
{
    // $mentions = array();
    $section_id = $_POST['section_id'];
    $eleve_id = $_POST['eleve_id'];
    $mention = $_POST['mentions'];

    $stmt = co_db()->prepare("SELECT matieres.nom, sections.section 
                                    FROM matieres, enseigner, sections
                                    WHERE matieres.identifiant = enseigner.matiere_id
                                    AND enseigner.section_id = sections.identifiant
                                    AND sections.identifiant = :section_id
                                    ORDER BY matieres.nom");
    $stmt->execute(array(':section_id' => $section_id));


    $sid1 = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($sid1, $row['nom']);
    }

    $i = 0;

    while ($i < count($mention)) {
        $matiere = $sid1[$i];
        $matiere_id = identifiantUneLigne("matieres", "identifiant", "nom", $matiere);
        $sql = "INSERT INTO  resultats(section_id, eleve_id, matiere_id, mentions) 
                    VALUES(:section_id, :eleve_id, :matiere_id, :mentions)";

        $query = co_db()->prepare($sql);
        $query->bindParam(':eleve_id', $eleve_id, PDO::PARAM_STR);
        $query->bindParam(':section_id', $section_id, PDO::PARAM_STR);
        $query->bindParam(':matiere_id', $matiere_id, PDO::PARAM_STR);
        $query->bindParam(':mentions', $mention[$i], PDO::PARAM_STR);
        $query->execute();
        $i++;
    }

    $lastInsertId = co_db()->lastInsertId();

    if ($lastInsertId) {
        return header('Location:../index.php?p=enseignement&m=1');
    } else {
        return header('Location:../index.php?p=enseignement&m=0');
    }
}

/**
 * Fonction qui affiche le relevé des notes d'un élève 
 * elle est traité en ajax
 * @param integer $eleve_id
 * @return void
 */
function afficheResultat(int $eleve_id)
{
    $sql_mention = co_db()->query("SELECT matieres.nom, resultats.mentions
                                FROM eleves, matieres, resultats, sections
                                WHERE resultats.eleve_id = $eleve_id
                                AND eleves.identifiant = resultats.eleve_id
                                AND resultats.matiere_id = matieres.identifiant
                                AND sections.identifiant = resultats.section_id");

    $resultat = $sql_mention->fetchAll();

    $sql_eleve = co_db()->query("SELECT eleves.nom_e, eleves.date_naissance, eleves.matricule, sections.section
                                        FROM eleves, resultats, sections
                                        WHERE eleves.identifiant = $eleve_id
                                        AND sections.identifiant = eleves.section_id");

    $sql_eleve = $sql_eleve->fetch();

    include_once '../pages/teste.php';
}

/**
 * Fontion qui vérifie si les résultats sont déjà enregistré
 *
 * @return void
 */
function verifierSiResultatDeclarer()
{
    $id = $_POST['studclass'];
    $dta = explode("$", $id);
    $id = $dta[0];
    $id1 = $dta[1];
    $query = co_db()->prepare("SELECT eleve_id, section_id 
                                    FROM resultats 
                                    WHERE eleve_id = :id1 
                                    AND section_id = :id ");
    $query->bindParam(':id1', $id1, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        $message = '<div class="alert alert-warning text-white alert-dismissible fade show" role="alert">
                        <strong>Coucou !</strong> Les résultat de cet élève sont déjà déclarés | vous ne pouvez que modifier si vous le souhaitez !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        echo "$message";
        echo "<script>$('#btn-ajout-resultat').prop('disabled', true);</script>";
    }
}

/**
 * Fonction qui affiche la liste des élèves dans le formulaire d'ajout 
 * des résultats
 *
 * @param integer $identifiant
 * @return void
 */
function elevesAjax_resulat(int $identifiant)
{
    if (!is_numeric($identifiant)) {
        echo htmlentities("Veillez vérifier la classe");
        exit;
    } else {
        $stmt = co_db()->prepare("SELECT nom_e, identifiant
                                        FROM eleves 
                                        WHERE section_id = $identifiant 
                                        ORDER BY nom_e");
        $stmt->execute(array($identifiant));
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<option value="">----------</option>';
        foreach ($row as $key) {
            echo '<option value="' . htmlentities($key['identifiant']) . '">' . htmlentities($key['nom_e']) . '</option>';
        }
    }
}
/**
 * Affiche la liste des matières enseignées dans une classe particulière 
 * la classe est passé en paramètre
 *
 * @param integer $identifiant
 * @return void
 */
function afficheMatieres(int $identifiant)
{
    if (!is_numeric($identifiant)) {
        echo htmlentities("La classe que vous avez saisi n'existe pas");
        exit;
    } else {
        $stmt = co_db()->prepare("SELECT matieres.nom, matieres.identifiant 
                                        FROM matieres, enseigner, sections
                                        WHERE matieres.identifiant = enseigner.matiere_id
                                        AND enseigner.section_id = sections.identifiant
                                        AND sections.identifiant = :section_id
                                        ORDER BY matieres.nom");
        $stmt->execute(array(':section_id' => $identifiant));

        // echo '<option value="">----------</option>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . htmlentities($row['identifiant']) . '">' . htmlentities($row['nom']) . '</option>';
        }
    }
}


function afficheFormulaireMatieres(int $identifiantClasse)
{
    $cid1 = intval($identifiantClasse);

    if (!is_numeric($cid1)) {
        echo htmlentities("invalid Class");
        exit;
    } else {
        $status = 0;
        $stmt = co_db()->prepare("SELECT matieres.nom, sections.section 
                                        FROM matieres, enseigner, sections
                                        WHERE matieres.identifiant = enseigner.matiere_id
                                        AND enseigner.section_id = sections.identifiant
                                        AND sections.identifiant = :section_id
                                        ORDER BY matieres.nom");
        $stmt->execute(array(':section_id' => $cid1));

        $html = '<div class="form-group">
                    <select class="form-control" name="mentions[]" id="" required>
                        <option value="" selected>----------</option>
                        <option>Honorable</option>
                        <option>Excellent</option>
                        <option>Très bien</option>
                        <option>Bien</option>
                        <option>Assez bien</option>
                        <option>Passable</option>
                        <option>insuffisant</option>
                        <option>Nul</option>
                        <option>Exclue</option>
                    </select>
                </div>';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo htmlentities($row['nom']);
            echo $html;
        }
    }
}
/**
 * fonction qui permet d'ajouter les absences
 *
 * @param integer $section_id
 * @param integer $eleve_id
 * @param integer $matiere_id
 * @param [type] $date_debut
 * @param [type] $date_fin
 * @param string $commentaire
 * @return void
 */
function ajoutAbsences(int $section_id, int $eleve_id, $date_debut, $date_fin, string $commentaire)
{
    $insert_donnees = co_db()->prepare("INSERT INTO absences(section_id, eleve_id, date_debut, date_fin, commentaire_absence)
    VALUES (?, ?, ?, ?, ?)");
    if ($insert_donnees->execute(array($section_id, $eleve_id, $date_debut, $date_fin, $commentaire))) {
        return header('Location:../index.php?p=absences&m=1');
    } else {
        return header('Location:../index.php?p=absences&m=0');
    }
}


/**
 * Fonction qui affiche la liste des absences d'une sectio passé en paramère 
 * 
 *
 * @param integer $identifiant
 * @return void
 */
function afficheAbsences(int $identifiant)
{
    if (!is_numeric($identifiant)) {
        echo htmlentities("Veillez vérifier la classe");
        exit;
    } else {
        $sql = co_db()->prepare("SELECT absences.identifiant, sections.section, matieres.nom, eleves.nom_e, eleves.matricule, absences.commentaire_absence, absences.date_debut, absences.date_fin, absences.commentaire_justifie, absences.date_ajout, absences.justifie
        FROM eleves, matieres, sections, absences
        WHERE sections.identifiant = $identifiant
        AND absences.section_id = sections.identifiant
        AND absences.eleve_id = eleves.identifiant
        AND absences.matiere_id = matieres.identifiant
        ORDER BY date_ajout");
        $sql->execute(array($identifiant));
        $absences = $sql->fetchAll(PDO::FETCH_ASSOC);

        $nb_absence = $sql->rowCount();

        include_once '../pages/utilitaires/absences.php';
    }
}


/**
 * Fonction qui affiche les détails d'un absence 
 * elle est traité en ajax
 * @param integer $eleve_id
 * @return void
 */
function afficheDetailAbsence(int $eleve_id_absence)
{
    $sql_eleve = co_db()->query("SELECT eleves.nom_e, eleves.matricule, sections.section, absences.*, matieres.nom
                                        FROM eleves, absences, sections, matieres
                                        WHERE absences.eleve_id = $eleve_id_absence
                                        AND sections.identifiant = absences.section_id
                                        AND matieres.identifiant = absences.matiere_id
                                        AND absences.eleve_id = eleves.identifiant");

    $existe = $sql_eleve->rowCount();

    if ($existe > 1) {
        $eleve = $sql_eleve->fetchAll();
    } else {
        $eleve = $sql_eleve->fetch();
    }
    include_once '../pages/utilitaires/details-absence.php';
}

function afficheAbsence(int $eleve_id_absence)
{
    $sql_eleve = co_db()->query("SELECT eleves.nom_e, eleves.matricule, sections.section, absences.*, matieres.nom
                                        FROM eleves, absences, sections, matieres
                                        WHERE absences.eleve_id = $eleve_id_absence
                                        AND sections.identifiant = absences.section_id
                                        AND matieres.identifiant = absences.matiere_id
                                        AND absences.eleve_id = eleves.identifiant");
    return $sql_eleve->fetch(PDO::FETCH_ASSOC);
}
/**
 * Fonction qui permet de justifier un absence
 *
 * @param string $commentaire
 * @param integer $identifiant
 * @return void
 */
function justifierAbsence(string $commentaire, int $identifiant)
{
    if (co_db()->query("UPDATE absences SET commentaire_justifie = '$commentaire', justifie = 1 WHERE identifiant = '$identifiant' ")) {
        return header('Location:../index.php?p=absences&m=1');
    }
}


/**
 * fonction qui retourne le nombre des absences non justifiés
 * @return int
 */
function nombreAbsenceNonJustifie(): int
{
    return (int) co_db()->query("SELECT COUNT(identifiant) FROM absences WHERE justifie = 0")->fetch(PDO::FETCH_NUM)[0];
}

/**
 * Retourne la liste des élève d'une classe particulière
 * @param integer $identifiantClasse
 * @return object
 */
function listeElevesParClasse(string $identifiantClasse): ?array
{
    $identifiantClasse = (int)$identifiantClasse;

    if (isset($identifiantClasse)) {
        $eleves = co_db()->query("SELECT * FROM eleves WHERE section_id = '$identifiantClasse' ORDER BY nom_e");
        if ($eleves->rowCount() != 0) {
            return $eleves->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
}

/**
 * Renvoie un tableau des mois pour l'année accadémique
 *
 * @return array
 */
function mois(): array
{
    $mois = [1 => "Janvier", 2 => "Fevrier", 3 => "Mars", 4 => "Avril", 5 => "Mais", 6 => "Juin", 7 => "Juillet", 8 => "Août", 9 => "Septembre", 10 => "Octobre", 11 => "Novembre", 12 => "Décembre"];
    return $mois;
}

/**
 * Fonction permettant de traiter les paiements
 *
 * @param integer $eleve_id | l'identifiant de l'élève qu'il a payer
 * @return void
 */
function traitementPaiement(int $eleve_id)
{
    /**
     * Nombre de mois coché
     * l'identifiant de l'élève et le bouton font parti du tableau
     * donc on soustrait 2 élements dans le tableau pour avoir le nombre de mois coché
     */
    $nombreMois = count($_POST) - 2;

    var_dump($nombreMois);
    if ($nombreMois >= 1) {
        $insert_donnees = co_db()->prepare("INSERT INTO paiement(eleve_id, nombre_mois)
        VALUES (?, ?)");
        if ($insert_donnees->execute(array($eleve_id, $nombreMois))) {
            return header('Location:../index.php?p=paiement&m=1');
        } else {
            return header('Location:../index.php?p=paiement&m=0');
        }
    }
}

/**
 * Retourne le nombre de mois payé
 *
 * @param integer $eleve_id : identifiant d'un elève
 * @return int|null
 */
function nombreMoisPayer(int $eleve_id): ?int
{
    $eleves = co_db()->query("SELECT eleve_id, SUM(nombre_mois) AS nombre_mois
                                FROM paiement
                                GROUP BY eleve_id
                                HAVING eleve_id = '$eleve_id'");
    $infos_paiement = $eleves->fetch(PDO::FETCH_ASSOC);
    return $infos_paiement['nombre_mois'];
}

/**
 * Elle retourne les information de paiement d'un élève passé en parametre
 *
 * @param integer $eleve_id : identifiant d'un élève
 * @return array|null
 */
function iformationsPaiement(int $eleve_id): ?array
{
    // $infosPaiement = co_db()->query("SELECT * FROM paiement WHERE eleve_id = '$eleve_id'");
    $infosPaiement = co_db()->query("SELECT eleve_id FROM paiement GROUP BY eleve_id HAVING eleve_id = '$eleve_id'");
    if ($infosPaiement->rowCount() != 0) {
        return $infosPaiement->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return null;
    }
}

function affichageMois(int $eleve_id)
{
    $infos = iformationsPaiement($eleve_id);

    if ($infos != null) {

        for ($i = 0; $i < count($infos); $i++) {

            // echo '<pre>';
            // print_r($infos[$i]['nombre_mois']);
            // echo '</pre>';

            return $infos[$i]['nombre_mois'];
        }
    } else {
        return null;
    }
}
