/**
 * Fonction permetant de coché les mois déjà payés
 */
function moisPayer() {
    const nombre_mois_payer = document.getElementsByClassName('nombre_mois_payer');
    const formulaires = document.getElementsByClassName("formulaire-paiement");

    // Parcout des formulaires
    for (let i = 0; i < formulaires.length; i++) 
    {
        for (let j = i; j < nombre_mois_payer.length; j++) 
        {
            const nombre_mois = nombre_mois_payer[j].textContent;
            // On parcout le tableau qui contient les formulaire
            const element = formulaires[j].elements;
            for (let k = 0; k < nombre_mois; k++) 
            {
                element[k].setAttribute('checked', true);
                element[k].removeAttribute('disabled');
                element[k+1].removeAttribute('disabled');
            }
        }
        
    }
}


function traitementPaiement() {
    // On selectionne les élements du formulaire
    const formulaires = document.getElementsByClassName("formulaire-paiement");
    var montantMensuel = document.getElementById("montant-mensuel");
    montantMensuel = parseFloat(montantMensuel.textContent);
    var montantTTC = 0;

    // On parcout les formulaire
    for (let i = 0; i < formulaires.length; i++) {
        var formulaire = formulaires[i];
        
        const champsCheckbox = formulaire.elements;
        // On parcout les éléments du formulaire
        for (let i = 0; i < champsCheckbox.length; i++) {
            const element = champsCheckbox[i];

            // On laisse activer le prmier input du formualaire
            for (let j = i+1; j < champsCheckbox.length; j++) {
                const element = champsCheckbox[j];
                element.setAttribute("disabled", true);
            }            

            // On écoute l'évènement sur l'élément courant
            element.addEventListener('input', () => {
                var elementSuvant = champsCheckbox[i+1];

                var boutonSubmit = champsCheckbox[champsCheckbox.length - 2];

                /**
                 * Si y a un input du formulaire qui activé, 
                 * On active le suivant et le bouton aussi 
                 */
                alert = document.getElementById("alert-montant");

                if (element.checked) {
                    montantTTC = montantTTC + montantMensuel;

                    // On active l'input suivant si le courant est activé
                    elementSuvant.removeAttribute("disabled");
                    // On active aussi le bouton
                    boutonSubmit.removeAttribute("disabled");
                }
                // Si on decoche une case, le suivant sera désactivé
                if (!element.checked) {
                    elementSuvant.setAttribute("disabled", true);
                    montantTTC = montantTTC - montantMensuel;
                }
                if (alert !== null) {
                    alert.innerHTML = `Montant à payer est de ${montantTTC} FCFA`;
                }

                if (montantTTC < 0) {
                    var alert_information = document.getElementsByClassName('alert-informatins');
                    console.log(alert_information);
                    
                    // alert_information.classList.remove('alert-info');

                    // console.log(alert_information);

                }
            })
        }
    }

    return montantTTC;
}

/**
 * Fonction qui permet de parcourir les calendrer d'une manière asynchrone
 */
function changement_calendrier() {
    // On récupère les élements qui ont la classe "changement-calandrier"
    const btn_changement_calandrier = document.getElementsByClassName('changement-calandrier');

    // On parcourt les élements un par un
    for (let i = 0; i < btn_changement_calandrier.length; i++) {
        btn = btn_changement_calandrier[i];
        btn.addEventListener('click', (e) => {
            // On évite le comportement par defaut (la rédirection)
            e.preventDefault();
        });

    }
}

/**
 * Fonction permetant de télécharger un pdf
 * @param {HTMLElement} btn : bouton à cliquer pour télécharger le pfd
 * @param {HTMLElement} id_element : Identifiant de l'élement à imprimer
 */
function pdf(btn, id_element) {
    document.getElementById(btn).addEventListener("click", () => {
        const page = this.document.getElementById(id_element);
        var opt = {
            margin: 1,
            filename: 'myfile.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };
        html2pdf().from(page).set(opt).save();
    })
}

/**
 * Fonction qui vérifie la page où on doit faire l'impression et imprime
 */
function impression() {
    const url = document.URL

    // On récupère tous les parmètres en commençant par p (page à exécutée)
    var parametres = url.split("?");

    // On récupère seulement le nom la page courante
    page = parametres[1].split("&")[0].substr(2);

    // par defaut, on considère qu'il n'existe pas d'autres paramètes que p (la page)
    var parametre = null;

    // si la taille du tableau parametres est superieur à 1, ce qui veut qu'il existe d'autres paramètres 
    if (parametres.length > 1) {
        parametre = parametres[1].split("&")[1].split("=")[0];
    }

    if (page === "enseignement") {
        /**
         * Appel de la fonction pour imprimer un relevé d'un élève
         */
        pdf("btn_telecharger_releve", "fiche_resultat");

        /**
         * Imprimer la liste des enseignants
         */
        pdf("im_liste_enseignant", "liste_enseignant");

    } else if (page === "eleves" && parametre === "id") {

        /**
         * Imprime la fiche de renseignement d'un élève 
         */
        pdf("btn_detail_eleve", "fiche_detail");

    }else if(page === "paiement"){

        impressionRecu();
    }
}

/**
 * Appel à la fonction impression
 */
impression();

traitementPaiement();

moisPayer();


// JavaScript Document
/*****************************************************************************
    ________________________________________________________________________	*
    	About 		:	Convertit jusqu'à  999 999 999 999 999 (billion)		*
    					avec respect des accords								*
    _________________________________________________________________________	*			
    	Auteur  	:	GALA OUSSE Brice, Engineer programmer of management		*
    	Mail    	:	bricegala@yahoo.fr, bricegala@gmail.com 				*
    	Tél	    	:	+237 99 37 95 83/ +237 79 99 82 80						*
    	Copyright 	:	avril  2007												*
    _________________________________________________________________________	*
*/

function Unite( nombre ){
	var unite;
	switch( nombre ){
		case 0: unite = "zéro";		break;
		case 1: unite = "un";		break;
		case 2: unite = "deux";		break;
		case 3: unite = "trois"; 	break;
		case 4: unite = "quatre"; 	break;
		case 5: unite = "cinq"; 	break;
		case 6: unite = "six"; 		break;
		case 7: unite = "sept"; 	break;
		case 8: unite = "huit"; 	break;
		case 9: unite = "neuf"; 	break;
	}//fin switch
	return unite;
}//-----------------------------------------------------------------------

function Dizaine( nombre ){
	switch( nombre ){
		case 10: dizaine = "dix"; break;
		case 11: dizaine = "onze"; break;
		case 12: dizaine = "douze"; break;
		case 13: dizaine = "treize"; break;
		case 14: dizaine = "quatorze"; break;
		case 15: dizaine = "quinze"; break;
		case 16: dizaine = "seize"; break;
		case 17: dizaine = "dix-sept"; break;
		case 18: dizaine = "dix-huit"; break;
		case 19: dizaine = "dix-neuf"; break;
		case 20: dizaine = "vingt"; break;
		case 30: dizaine = "trente"; break;
		case 40: dizaine = "quarante"; break;
		case 50: dizaine = "cinquante"; break;
		case 60: dizaine = "soixante"; break;
		case 70: dizaine = "soixante-dix"; break;
		case 80: dizaine = "quatre-vingt"; break;
		case 90: dizaine = "quatre-vingt-dix"; break;
	}//fin switch
	return dizaine;
}//-----------------------------------------------------------------------

/**
 * 
 * @param {int} nombre 
 * @returns chaine de caratctère: le nombre converti en lettre
 */
function NumberToLetter( nombre ){
	var i, j, n, quotient, reste, nb ;
	var ch
	var numberToLetter='';
	//__________________________________
	
	if(  nombre.toString().replace( / /gi, "" ).length > 15  )	return "dépassement de capacité";
	if(  isNaN(nombre.toString().replace( / /gi, "" ))  )		return "Nombre non valide";

	nb = parseFloat(nombre.toString().replace( / /gi, "" ));
	if(  Math.ceil(nb) != nb  )	return  "Nombre avec virgule non géré.";
	
	n = nb.toString().length;
	switch( n ){
		 case 1: numberToLetter = Unite(nb); break;
		 case 2: if(  nb > 19  ){
					   quotient = Math.floor(nb / 10);
					   reste = nb % 10;
					   if(  nb < 71 || (nb > 79 && nb < 91)  ){
							 if(  reste == 0  ) numberToLetter = Dizaine(quotient * 10);
							 if(  reste == 1  ) numberToLetter = Dizaine(quotient * 10) + "-et-" + Unite(reste);
							 if(  reste > 1   ) numberToLetter = Dizaine(quotient * 10) + "-" + Unite(reste);
					   }else numberToLetter = Dizaine((quotient - 1) * 10) + "-" + Dizaine(10 + reste);
				 }else numberToLetter = Dizaine(nb);
				 break;
		 case 3: quotient = Math.floor(nb / 100);
				 reste = nb % 100;
				 if(  quotient == 1 && reste == 0   ) numberToLetter = "cent";
				 if(  quotient == 1 && reste != 0   ) numberToLetter = "cent" + " " + NumberToLetter(reste);
				 if(  quotient > 1 && reste == 0    ) numberToLetter = Unite(quotient) + " cents";
				 if(  quotient > 1 && reste != 0    ) numberToLetter = Unite(quotient) + " cent " + NumberToLetter(reste);
				 break;
		 case 4 :  quotient = Math.floor(nb / 1000);
					  reste = nb - quotient * 1000;
					  if(  quotient == 1 && reste == 0   ) numberToLetter = "mille";
					  if(  quotient == 1 && reste != 0   ) numberToLetter = "mille" + " " + NumberToLetter(reste);
					  if(  quotient > 1 && reste == 0    ) numberToLetter = NumberToLetter(quotient) + " mille";
					  if(  quotient > 1 && reste != 0    ) numberToLetter = NumberToLetter(quotient) + " mille " + NumberToLetter(reste);
					  break;
		 case 5 :  quotient = Math.floor(nb / 1000);
					  reste = nb - quotient * 1000;
					  if(  quotient == 1 && reste == 0   ) numberToLetter = "mille";
					  if(  quotient == 1 && reste != 0   ) numberToLetter = "mille" + " " + NumberToLetter(reste);
					  if(  quotient > 1 && reste == 0    ) numberToLetter = NumberToLetter(quotient) + " mille";
					  if(  quotient > 1 && reste != 0    ) numberToLetter = NumberToLetter(quotient) + " mille " + NumberToLetter(reste);
					  break;
		 case 6 :  quotient = Math.floor(nb / 1000);
					  reste = nb - quotient * 1000;
					  if(  quotient == 1 && reste == 0   ) numberToLetter = "mille";
					  if(  quotient == 1 && reste != 0   ) numberToLetter = "mille" + " " + NumberToLetter(reste);
					  if(  quotient > 1 && reste == 0    ) numberToLetter = NumberToLetter(quotient) + " mille";
					  if(  quotient > 1 && reste != 0    ) numberToLetter = NumberToLetter(quotient) + " mille " + NumberToLetter(reste);
					  break;
		 case 7: quotient = Math.floor(nb / 1000000);
					  reste = nb % 1000000;
					  if(  quotient == 1 && reste == 0  ) numberToLetter = "un million";
					  if(  quotient == 1 && reste != 0  ) numberToLetter = "un million" + " " + NumberToLetter(reste);
					  if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " millions";
					  if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " millions " + NumberToLetter(reste);
					  break;  
		 case 8: quotient = Math.floor(nb / 1000000);
					  reste = nb % 1000000;
					  if(  quotient == 1 && reste == 0  ) numberToLetter = "un million";
					  if(  quotient == 1 && reste != 0  ) numberToLetter = "un million" + " " + NumberToLetter(reste);
					  if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " millions";
					  if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " millions " + NumberToLetter(reste);
					  break;  
		 case 9: quotient = Math.floor(nb / 1000000);
					  reste = nb % 1000000;
					  if(  quotient == 1 && reste == 0  ) numberToLetter = "un million";
					  if(  quotient == 1 && reste != 0  ) numberToLetter = "un million" + " " + NumberToLetter(reste);
					  if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " millions";
					  if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " millions " + NumberToLetter(reste);
					  break;  
		 case 10: quotient = Math.floor(nb / 1000000000);
						reste = nb - quotient * 1000000000;
						if(  quotient == 1 && reste == 0  ) numberToLetter = "un milliard";
						if(  quotient == 1 && reste != 0  ) numberToLetter = "un milliard" + " " + NumberToLetter(reste);
						if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " milliards";
						if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " milliards " + NumberToLetter(reste);
					    break;	
		 case 11: quotient = Math.floor(nb / 1000000000);
						reste = nb - quotient * 1000000000;
						if(  quotient == 1 && reste == 0  ) numberToLetter = "un milliard";
						if(  quotient == 1 && reste != 0  ) numberToLetter = "un milliard" + " " + NumberToLetter(reste);
						if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " milliards";
						if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " milliards " + NumberToLetter(reste);
					    break;	
		 case 12: quotient = Math.floor(nb / 1000000000);
						reste = nb - quotient * 1000000000;
						if(  quotient == 1 && reste == 0  ) numberToLetter = "un milliard";
						if(  quotient == 1 && reste != 0  ) numberToLetter = "un milliard" + " " + NumberToLetter(reste);
						if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " milliards";
						if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " milliards " + NumberToLetter(reste);
					    break;	
		 case 13: quotient = Math.floor(nb / 1000000000000);
						reste = nb - quotient * 1000000000000;
						if(  quotient == 1 && reste == 0  ) numberToLetter = "un billion";
						if(  quotient == 1 && reste != 0  ) numberToLetter = "un billion" + " " + NumberToLetter(reste);
						if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " billions";
						if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " billions " + NumberToLetter(reste);
					    break; 	
		 case 14: quotient = Math.floor(nb / 1000000000000);
						reste = nb - quotient * 1000000000000;
						if(  quotient == 1 && reste == 0  ) numberToLetter = "un billion";
						if(  quotient == 1 && reste != 0  ) numberToLetter = "un billion" + " " + NumberToLetter(reste);
						if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " billions";
						if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " billions " + NumberToLetter(reste);
					    break; 	
		 case 15: quotient = Math.floor(nb / 1000000000000);
						reste = nb - quotient * 1000000000000;
						if(  quotient == 1 && reste == 0  ) numberToLetter = "un billion";
						if(  quotient == 1 && reste != 0  ) numberToLetter = "un billion" + " " + NumberToLetter(reste);
						if(  quotient > 1 && reste == 0   ) numberToLetter = NumberToLetter(quotient) + " billions";
						if(  quotient > 1 && reste != 0   ) numberToLetter = NumberToLetter(quotient) + " billions " + NumberToLetter(reste);
					    break; 	
	 }//fin switch
	 /*respect de l'accord de quatre-vingt*/
	 if(  numberToLetter.substr(numberToLetter.length-"quatre-vingt".length,"quatre-vingt".length) == "quatre-vingt"  ) numberToLetter = numberToLetter + "s";
	 
	 return numberToLetter;
}//-----------------------------------------------------------------------


function convertirSomme() {
    const somme = document.getElementById('somme-paye').textContent;
    const somme_lettre = document.getElementById('somme-en-lettre');

    somme_lettre.innerHTML = `${NumberToLetter(somme)}`;
    console.log(NumberToLetter(somme));
    NumberToLetter(somme)
}

// convertirSomme();

function impressionRecu() {
    const btnImprimeRecu = document.getElementsByClassName('imprimer-recu-paiement');

    for (let i = 0; i < btnImprimeRecu.length; i++) {
        const btn = btnImprimeRecu[i];

        btn.addEventListener('click', (e) => {
            e.preventDefault();
        })
        var href = btn.attributes['href'].value.substr(-1);
        // var btn_id = btn.attributes['id'].value;
        if (pdf("imprimer-recu-paiement-"+href, "recu-paiement"+href)) {
            return;
        }
        
    }
}

impressionRecu();