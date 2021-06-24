<?php


namespace App;

class Valide
{
    private $donnees;
    protected $erreurs = [];


    public function __construct(array $donnees = [])
    {
        $this->vadonneesr = $donnees;
    }
    /**
     * validee
     *
     * @param  mixed $donnees
     * @return void
     */
    public function validees(array $donnees)
    {
        $this->erreurs = [];
        $this->donnees = $donnees;

        return $this->erreurs;
    }

    /**
     * validee
     *
     * @param  mixed $champ
     * @param  mixed $regle_validation
     * @param  mixed $parametres
     * @return bool
     */
    public function validee(string $champ, string $regle_validation, ...$parametres)
    {
        if (!isset($this->donnees[$champ])) {
            $this->erreurs[$champ] = "Le champs $champ n'est pas rempli";
            return FALSE;
        } else {
            return call_user_func([$this, $regle_validation], $champ, ...$parametres);
        }
    }

    /**
     * taille_min
     *
     * @param  mixed $champ
     * @param  mixed $taille
     * @return void
     */
    public function taille_min(string $champ, int $taille)
    {
        if (mb_strlen($champ) < $taille) {
            $this->erreurs[$champ] = "Le champs $champ doit avoir au minimum $taille caractères pour bien être explicite !";
        }
    }

    /**
     * date_valide
     *
     * @param  mixed $champ
     * @return bool
     */
    public function date_valide(string $champ): bool
    {
        if (\DateTime::createFromFormat('Y-m-d', $this->donnees[$champ]) === FALSE) {
            $this->erreurs[$champ] = "La date ne semble pas valide !";
            return FALSE;
        }
        return TRUE;
    }


    /**
     * heure_valide
     *
     * @param  mixed $champ
     * @return bool
     */
    public function heure_valide(string $champ): bool
    {
        if (\DateTime::createFromFormat('H:i', $this->donnees[$champ]) === FALSE) {
            $this->erreurs[$champ] = "Le temps ne semble pas validem veillez vérifier s'il vous plait !";
            return FALSE;
        }
        return TRUE;
    }

    /**
     * avant
     * @param  mixed $champ_avant
     * @param  mixed $champ_apres
     * @return void
     */
    public function avant(string $champ_avant, string $champ_apres)
    {
        if ($this->heure_valide($champ_avant) && $this->heure_valide($champ_apres)) {
            $heure_debut = \DateTime::createFromFormat('H:i', $this->donnees[$champ_avant]);
            $heure_fin = \DateTime::createFromFormat('H:i', $this->donnees[$champ_apres]);

            if ($heure_debut->getTimestamp() > $heure_fin->getTimestamp()) {
                $this->erreurs[$champ_avant] = "Le temps de début de l'évènement doit être inférieur au temps de fin";
                return FALSE;
            }
            return TRUE;
        }
        return FALSE;
    }
    /**
     * avant
     *
     * @param  mixed $champ_avant
     * @param  mixed $champ_apres
     * @return void
     */
    public function avant_date(string $champ_avant, string $champ_apres)
    {
        if ($this->date_valide($champ_avant) && $this->date_valide($champ_apres)) {
            $heure_debut = \DateTime::createFromFormat('Y-m-d', $this->donnees[$champ_avant]);
            $heure_fin = \DateTime::createFromFormat('Y-m-d', $this->donnees[$champ_apres]);

            if ($heure_debut > $heure_fin) {
                $this->erreurs[$champ_avant] = "La date de début de l'évènement doit être inférieur à la date de fin";
                return FALSE;
            }
            return TRUE;
        }
        return FALSE;
    }
}
