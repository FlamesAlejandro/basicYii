<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>

<h1> Muestra del CRUD </h1>

<div class="row">

<?php foreach ($libros as libro): ?>
    
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <a href="#" class="thumbnail">
            <img data-src="#" alt="">
        </a>
    </div>

<?php endforeach; ?>

</div>