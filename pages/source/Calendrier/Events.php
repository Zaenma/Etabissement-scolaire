<?php


namespace Calendrier;

class Events
{
    private $Id;


    private $Nom;

    private $Type_evenement;

    private $Description;


    private $date_debut;


    private $Date_fin;
    /**
     * Get the value of date_debut
     *
     * @return  mixed
     */
    public function getDate_debut(): \DateTime
    {
        return new \DateTime($this->date_debut);
    }

    /**
     * Set the value of date_debut
     *
     * @param   mixed  $date_debut  
     *
     * @return  self
     */
    public function setDate_debut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    /**
     * Get the value of date_fin
     *
     * @return  mixed
     */
    public function getDate_fin(): \DateTime
    {
        return new \DateTime($this->Date_fin);
    }

    /**
     * Set the value of date_fin
     *
     * @param   mixed  $date_fin  
     *
     * @return  self
     */
    public function setDate_fin($date_fin)
    {
        $this->Date_fin = $date_fin;
    }

    /**
     * Get the value of Id
     *
     * @return  mixed
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Set the value of Id
     *
     * @param   mixed  $Id  
     *
     * @return  self
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    /**
     * Get the value of Nom
     *
     * @return  mixed
     */
    public function getNom()
    {
        return $this->Nom;
    }

    /**
     * Set the value of Nom
     *
     * @param   mixed  $Nom  
     *
     * @return  self
     */
    public function setNom($Nom)
    {
        $this->Nom = $Nom;
    }

    /**
     * Get the value of Description
     *
     * @return  mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * Set the value of Description
     *
     * @param   mixed  $Description  
     *
     * @return  self
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    /**
     * Get the value of Type_evenement
     *
     * @return  mixed
     */
    public function getType_evenement()
    {
        return $this->Type_evenement;
    }

    /**
     * Set the value of Type_evenement
     *
     * @param   mixed  $Type_evenement  
     *
     * @return  self
     */
    public function setType_evenement($Type_evenement)
    {
        $this->Type_evenement = $Type_evenement;
    }

    /**
     * Get the value of heure_debut
     *
     * @return  mixed
     */
    public function getHeure_debut()
    {
        return $this->heure_debut;
    }

    /**
     * Set the value of heure_debut
     *
     * @param   mixed  $heure_debut  
     *
     * @return  self
     */
    public function setHeure_debut($heure_debut)
    {
        $this->heure_debut = $heure_debut;

        return $this;
    }

    /**
     * Get the value of heure_fin
     *
     * @return  mixed
     */
    public function getHeure_fin()
    {
        return $this->heure_fin;
    }

    /**
     * Set the value of heure_fin
     *
     * @param   mixed  $heure_fin  
     *
     * @return  self
     */
    public function setHeure_fin($heure_fin)
    {
        $this->heure_fin = $heure_fin;

        return $this;
    }
}
