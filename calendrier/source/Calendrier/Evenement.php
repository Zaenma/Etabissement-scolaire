<?php

namespace Calendrier;

class Evenement
{
  /**
   * __construct
   *
   * @param  mixed $pdo
   * @return void
   */
  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  /**
   * recupere les évenement commençant par deux date données
   * @param \DateTime $debutEvenement
   * @param \DateTime $finEvenement
   * 
   * @return array
   */
  public function recupereEvenements(\DateTime $debutEvenement, \DateTime $finEvenement): array
  {
    $sql = "SELECT * FROM Evenements WHERE '{$debutEvenement->format('Y-m-d 00:00:00')}' AND '{$finEvenement->format('Y-m-d 23:59:59')}'";

    $selectionneEvenement = $this->pdo->query($sql);
    $resultats = $selectionneEvenement->fetchAll();
    return $resultats;
  }

  /**
   * recupere les évenement commençant par deux date données indexé par jour
   * @param \DateTime $debutEvenement
   * @param \DateTime $finEvenement
   * 
   * @return array
   */
  public function recupereEvenementParJour(\DateTime $debutEvenement, \DateTime $finEvenement): array
  {
    $evenements = $this->recupereEvenements($debutEvenement, $finEvenement);

    $t_jours = [];

    foreach ($evenements as $evenement) {
      $dateEvenement = explode(' ', $evenement['date_debut'])[0];
      if (!isset($t_jours[$dateEvenement])) {
        $t_jours[$dateEvenement] = [$evenement];
      } else {
        $t_jours[$dateEvenement][] = $evenement;
      }
    }
    return $t_jours;
  }

  /**
   * afficheEvenement
   *
   * @param  mixed $id_evenement
   * @return array
   */
  public function afficheEvenement(int $id_evenement)
  {
    $sql =  $this->pdo->query("SELECT * FROM Evenements WHERE Id = $id_evenement LIMIT 1");
    $sql->setFetchMode(\PDO::FETCH_CLASS, \Calendrier\Events::class);
    $resultats = $sql->fetch();
    if ($resultats === FALSE) {
      throw new \Exception("Aucun résultat n'a été trouvé !");
    }
    return $resultats;
  }

  /**
   * creer_evenement
   *
   * @param  mixed $evenement
   * @return bool
   */
  public function creer_evenement(Events $evenement): bool
  {
    $sql = $this->pdo->prepare("INSERT INTO Evenements(Nom, Type_evenement, Description, date_debut, Date_fin) VALUES(?, ?, ?, ?, ?)");
    return $sql->execute([
      $evenement->getNom(),
      $evenement->getType_evenement(),
      $evenement->getDescription(),
      $evenement->getDate_debut()->format('Y-m-d H:i:s'),
      $evenement->getDate_fin()->format('Y-m-d H:i:s'),
    ]);
  }

  /**
   * éditer un évènement
   *
   * @param Events $evenement
   * @return boolean : oui si l'évènement a bien été modifié
   */
  public function edite_evenement(Events $evenement): bool
  {
    $sql = $this->pdo->prepare("UPDATE Evenements SET Nom = ?, Type_evenement = ?, Description = ?, date_debut = ?, Date_fin = ? WHERE Id = ?");
    return $sql->execute([
      $evenement->getNom(),
      $evenement->getType_evenement(),
      $evenement->getDescription(),
      $evenement->getDate_debut()->format('Y-m-d H:i:s'),
      $evenement->getDate_fin()->format('Y-m-d H:i:s'),
      $evenement->getId()
    ]);
  }
}
