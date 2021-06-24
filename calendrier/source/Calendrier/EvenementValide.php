<?php

namespace Calendrier;

use App\Valide;

class EvenementValide extends Valide
{
    public function validees(array $donnees)
    {
        parent::validees($donnees);
        $this->validee('titre', 'taille_min', 5);
        $this->validee('type-evenement', 'taille_min', 5);
        $this->validee('date_debut', 'date_valide');
        $this->validee('date_fin', 'date_valide');
        $this->validee('heure_debut', 'avant', 'heure_fin');
        $this->validee('date_debut', 'avant_date', 'date_fin');
        return $this->erreurs;
    }
}
