<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libros".
 *
 * @property int $id
 * @property string $titulo
 * @property string $img
 */
class Libro extends \yii\db\ActiveRecord
{
    // para subir el archivo
    public $archivo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo'], 'required'],
            [['titulo'], 'string', 'max' => 255],
            [['archivo'], 'file', 'extensions'=>'jpg,png'],

        ];
    }

    /**
     * {@inheritdoc}
     */

     //Estas solo son las etiquetas que se muestran en el formulario
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'archivo' => 'Img',
        ];
    }
}
