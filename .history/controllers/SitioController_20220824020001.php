<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessController;;
use yii\web\Controller;

use app\models\FormularioForm;

class SitioController extends Controller
{
    public function actionInicio() {

        $model= new FormularioForm;

        // Si llega un post del modelo, y si la validacion es correcta
        if( $model->load(Yii::$app->request->post() ) && $model->validate() ){
            $valorRespuesta= ("El resultado es:".$model->valor1+$model->valor2)
        }

        return $this->render('inicio', ['model'=>$model]);
    }
}

?>