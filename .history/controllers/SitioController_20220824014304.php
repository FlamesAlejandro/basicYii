<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessController;;
use yii\web\Controller;

use app\models\FormularioForm;

class SitioController extends Controller
{
    public function actionInicio() {
        return $this->render('inicio');
    }
}

?>