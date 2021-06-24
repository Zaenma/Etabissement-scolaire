<?php

namespace Emplois;

class Emplois
{
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}
