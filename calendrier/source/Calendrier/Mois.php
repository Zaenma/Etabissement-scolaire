<?php

namespace Calendrier;

class Mois
{
  public $t_jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
  private $t_mois = ['Janvier', 'Février', 'Mars', 'Avril', 'Mais', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

  public $mois;
  public $annee;
  /**
   * @param integer $mois le mois commence par 1 à 12 
   * @param integer $annee
   * 
   * @return void
   */
  public function __construct(?int $mois = NULL, ?int $annee = NULL)
  {
    if ($mois === NULL || $mois < 1 || $mois > 12) {
      $mois = intval(date('m'));
    }
    if ($annee === NULL) {
      $annee = intval(date('Y'));
    }

    if ($mois < 1 || $mois > 12) {
      throw new \Exception("Le mois $mois n'est pas valide !");
    }

    // $mois = $mois % 12;

    if ($annee < 1970) {
      throw new \Exception("L'année est inférieure à 1970 !");
    }

    $this->mois = $mois;
    $this->annee = $annee;
  }

  /**
   * retourne un mois en lettre EX : Mars Avril 2020
   * @return string
   */
  public function convertisseurMois(): string
  {
    return $this->t_mois[$this->mois - 1] . ' ' . $this->annee;
  }

  /**
   * retourne le premier jour du mois
   * @return \DateTime
   */
  public function premierJourduMois(): \DateTime
  {
    return new \DateTime("{$this->annee}-{$this->mois}-01");
  }
  /**
   * retiur le nombre de nombre de semaines
   * @return int
   */
  public function nombreJours(): int
  {

    $debutMois = $this->premierJourduMois();
    $finMois = (clone $debutMois)->modify('+1 month -1 day');

    $debuSemaine = intval($debutMois->format('W'));
    $finSemaine = intval($finMois->format('W'));

    if ($finSemaine === 1) {
      $finSemaine = intval((clone $finMois)->modify('-7 days')->format('W')) + 1;
    }
    $jours = $finSemaine - $debuSemaine + 1;
    if ($jours < 0) {
      $jours = $finMois->format('W');
    }
    return $jours;
  }

  /**
   * savoir si le jour est dans le mois ou pas 
   * @param \DateTime $date
   * 
   * @return bool
   */
  public function estJourDuLeMois(\DateTime $date): bool
  {
    return $this->premierJourduMois()->format('Y-m') === $date->format('Y-m');
  }

  /**
   * retourne le mois suivant
   * @return Mois
   */
  public function moisSuivant(): Mois
  {
    $mois = $this->mois + 1;
    $annee = $this->annee;
    if ($mois > 12) {
      $mois = 1;
      $annee += 1;
    }
    return new Mois($mois, $annee);
  }

  /**
   * retourne le mois précedent
   * @return Mois
   */
  public function moisPrecendent(): Mois
  {
    $mois = $this->mois - 1;
    $annee = $this->annee;
    if ($mois < 1) {
      $mois = 12;
      $annee -= 1;
    }
    return new Mois($mois, $annee);
  }
}
