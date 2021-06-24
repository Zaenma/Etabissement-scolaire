/**
 * la fonction qui affiche la liste des élèves et les matières 
 * après avoir selectionner la classe
 * @param {*} val 
 */
function getStudent(val) {
    // alert(val);
  $.ajax({
      type: "POST",
      url: "../fonctions/traitements.php",
      data: 'classid=' + val,
      success: function(data) {
          $("#studentid").html(data);
      }
  });

  $.ajax({
      type: "POST",
      url: "../fonctions/traitements.php",
      data: 'classid1=' + val,
      success: function(data) {
          $("#subject").html(data);

      }
  });
}

function traitementAbsences(val) {
    // alert(val);
  $.ajax({
      type: "POST",
      url: "../fonctions/traitements.php",
      data: 'id_section_absence=' + val,
      success: function(data) {
          $("#id-eleve-absence").html(data);
      }
  });

  $.ajax({
      type: "POST",
      url: "../fonctions/traitements.php",
      data: 'id_section_absence1=' + val,
      success: function(data) {
          $("#matiere-absences").html(data);

      }
  });
}
/**
 * elle vérifie si les résultats sont déjà déclarés
 * @param {*} val 
 * @param {*} clid 
 */
function getresult(val, clid) {
    var clid = $(".clid").val();
    var val = $(".stid").val();;
    var abh = clid + '$' + val;
    // alert(abh);
    $.ajax({
        type: "POST",
        url: "../fonctions/traitements.php",
        data: 'studclass=' + abh,
        success: function(data) {
            $("#reslt").html(data);
        }
    });
}


$(function($) {
    $(".js-states").select2();
    $(".js-states-limit").select2({
        maximumSelectionLength: 2
    });
    $(".js-states-hide").select2({
        minimumResultsForSearch: Infinity
    });
});

function afficheEleves(identifiant) {
    // alert(identifiant);
    $.ajax({
        type: "POST",
        url: "../fonctions/traitements.php",
        data: 'section_id=' + identifiant,
        success: function(data) {
            $("#eleve").html(data);
        }
    });
}

/**
 * la foction permet de renvoyer les absences d'une section
 * @param {int} identifiant l'identifiant de la section
 */
function afficheAbsences(identifiant) {
    // alert(identifiant);
    $.ajax({
        type: "POST",
        url: "../fonctions/traitements.php",
        data: 'section_absence_id=' + identifiant,
        success: function(data) {
            $("#affiche-absence").html(data);
        }
    });

    $.ajax({
        type: "POST",
        url: "../fonctions/traitements.php",
        data: 'section_absence_id1=' + identifiant,
        success: function(data) {
            $("#eleve_absence").html(data);
  
        }
    });

}

function afficheElevesAbsence(identifiant) {
    // alert(identifiant);
    $.ajax({
        type: "POST",
        url: "../fonctions/traitements.php",
        data: 'id_section_absence=' + identifiant,
        success: function(data) {
            $("#id_eleve_absence").html(data);
        }
    });

    $.ajax({
        type: "POST",
        url: "../fonctions/traitements.php",
        data: 'eleve_absence=' + identifiant,
        success: function(data) {
            $("#matiere_absence").html(data);
  
        }
    });
}

function afficheReleve(identifiant) {
    // alert(identifiant);
    $.ajax({
        type: "POST",
        url: "../fonctions/traitements.php",
        data: 'id_eleve=' + identifiant,
        success: function(data) {
            $("#resultats").html(data);
        }
    });
}

/**
 * 
 * @param {int} identifiant d'un élève qui est absent
 */
function afficheDetails(identifiant) {
    // alert(identifiant);
    $.ajax({
        type: "POST",
        url: "../fonctions/traitements.php",
        data: 'eleve_absence=' + identifiant,
        success: function(data) {
            $("#affiche-absence").html(data);
        }
    });
}


//-----------------------------------------------------------------

