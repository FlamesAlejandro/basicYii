<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;

?>

cacha

<?php 
    $formulario=ActiveForm::begin();
?>

<?= $formulario->field($model, 'valor1') ?>

<?= $formulario->field($model, 'valor2') ?>