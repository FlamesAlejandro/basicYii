<?php

namespace app\models;

use yii\base\Model;

class ClassName extends Model
{
    public $valor1;
    public $valor2;

    public function rules(){

        return[
            [['valor1', 'valor2'], 'required'],
            ['valor1','number'],['valorb','number']
        ];

    }
}


?>