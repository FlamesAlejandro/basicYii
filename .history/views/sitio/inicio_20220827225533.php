<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;

?>

<?php

    // imprimir el resultado de la suma, con yii2 podemos hacer html y crear un componente con clase
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