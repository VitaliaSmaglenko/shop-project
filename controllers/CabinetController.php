<?php
/**
 * Controller CabinetController
 */

class CabinetController
{
    public function actionIndex()
    {
        include_once ('views/cabinet.php');
        return true;
    }

}