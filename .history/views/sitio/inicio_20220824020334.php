<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;

?>

<?php

    if($mensaje){
        echo Html::tag('div', Html::encode($mensaje), ['class'=> 'alert alert-danger']);
    }

?>

cacha

<!-- creado un formulario -->
<?php 
    $formulario=ActiveForm::begin();
?>

<?= $formulario->field($model, 'valor1') ?>

<?= $formulario->field($model, 'valor2') ?>

<div class="form-group">
    <?= Html::submitButton('Enviar',['class'=>'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>