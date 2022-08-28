<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>

<h1> Muestra del CRUD </h1>

<div class="row">

<?php foreach ($libros as $libro): ?>

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <a href="#" class="thumbnail">
            
            <?= Html::img($libro->img); ?>
            <?= Html::encode("{$libro->titulo}"); ?>

        </a>
    </div>

<?php endforeach; ?>

</div>

<?= LinkPager::widget(['pagination'=>$pagination]) ?>