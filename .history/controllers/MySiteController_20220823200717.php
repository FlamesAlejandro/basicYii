<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessController;;
use yii\web\Controller;

class MySiteController extends Controller
{
    public function actionInicio() {
        return $this->render('myindex');
    }
}

?>