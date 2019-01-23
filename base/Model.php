<?php
/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 22.01.2019
 * Time: 17:05
 */

namespace Base;
use App\PDODB;

abstract class Model
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new PDODB();
    }
}