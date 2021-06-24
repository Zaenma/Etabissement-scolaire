<?php

require_once 'fonctions.php';

if (!empty($_POST['btn-connexion'])) {
    connexion_admin($_POST['identifiant'], $_POST['password']);
}

// traitement du formulaire d'ajout d'une section
if (!empty($_POST['btn-ajout-section'])) {
    ajoutSection($_POST['section'], $_POST['montant_inscription'], $_POST['montant_mensuel'], $_POST['effectif']);
}

if (!empty($_POST['btn-ajout-matiere'])) {
    ajoutUneLigne($_POST['matiere'], 'matieres', 'nom');
}

if (!empty($_POST['btn-ajout-enseignement'])) {
    cles_etrangere_enseigner($_POST['section_id'], $_POST['matiere_id'], $_POST['enseignant_id']);
}


if (isset($_GET['sup']) && !empty($_GET['sup'])) {
    suppression_element_id_en_get($_GET['sup'], 'identifiant', 'sections');
}

if (!empty($_POST['btn-modifier-section'])) {
    modifierClasse($_POST['section'], $_POST['identifiant']);
}


if (!empty($_POST['btn-ajout-eleve'])) {

    extract($_POST);

    ajoutEleves($nom_e, $date_naissance, $religion, $emprinte, $malade, $symptome, $ecole, $infos_ecole, $section_id, $nom_r, $telephone, $email, $profession, $adresse, $motif, $lien, $engagement);
}


if (!empty($_POST['btn-ajout-enseignant'])) {
    ajoutEnseignant($_POST['nom'], $_POST['telephone'], $_POST['email'], $_POST['residence']);
}


// if (!empty($_POST['btn-ajout-ens-mat'])) {
//     cles_etrangere_dispenser($_POST['enseignant_id'], $_POST['matiere_id']);
// }


if (!empty($_POST['section_id'])) {
    elevesAjax_resulat($_POST['section_id']);
}
// Traitement avec ajax
if (!empty($_POST["classid"])) {
    elevesAjax_resulat($_POST["classid"]);
}


// traitement du formulaire pour les absences
if (!empty($_POST["id_section_absence"])) {
    elevesAjax_resulat($_POST["id_section_absence"]);
}

// Recupération des matière pour les afficher dans le formulaire d'ajout d'absences
if (!empty($_POST['id_section_absence1'])) {
    afficheMatieres($_POST['id_section_absence1']);
}

// Recupération des élèves pour les afficher dans le formulaire de recherche de l'absence d'une élève
if (!empty($_POST['section_absence_id1'])) {
    elevesAjax_resulat($_POST['section_absence_id1']);
}

// Bouton d'ajout des résul
if (!empty($_POST['btn-ajout-resultat'])) {
    ajoutResultat();
}

// Traitement d'affichages de relevés
if (!empty($_POST['id_eleve'])) {
    afficheResultat($_POST['id_eleve']);
}

// Ajout des absences
if (!empty($_POST['btn-ajout-absence'])) {
    $date_debut = $_POST['date-absence'] . ' ' . $_POST['heure-debut-absence'];
    $date_fin = $_POST['date-absence'] . ' ' . $_POST['heure-fin-absence'];

    // var_dump($date_fin);
    ajoutAbsences($_POST['id_section_absence'], $_POST['eleve-absence'], $date_debut, $date_fin, $_POST['commentaire-absence']);
}

// affichage des absences
if (!empty($_POST['section_absence_id'])) {
    afficheAbsences($_POST['section_absence_id']);
}

// Affiche les détails d'une absence
if (!empty($_POST['eleve_absence'])) {
    afficheDetailAbsence($_POST['eleve_absence']);
}

// Traitement du formulaire de justification d'un absense
if (!empty($_POST['btn-justification-absence'])) {
    justifierAbsence($_POST['justification'], $_POST['id']);
}

// Traitement de formulaire de paiement
if (!empty($_POST['btn-ajout-paiement'])) {
    // traitementPaiement($_POST['eleve']);

    var_dump($_POST);
}

// Traitement d'affichage du formulaire de remplissage des notes de chaque matières
if (!empty($_POST["classid1"])) {
    afficheFormulaireMatieres($_POST['classid1']);
}

// On vérifie si les résultats d'un élève en particulier sont déjà délibérés
if (!empty($_POST["studclass"])) {
    verifierSiResultatDeclarer();
}
