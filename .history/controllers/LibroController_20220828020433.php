<?php

namespace app\controllers;

use app\models\Libro;
use app\models\LibroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

// nos permite subir archivos, como las img
use yii\web\UploadedFile;

// para mostrar los libros, los enviaremos paginados
use yii\data\Pagination;
/**
 * LibroController implements the CRUD actions for Libro model.
 */
class LibroController extends Controller
{
    /**
     * @inheritDoc
     */

     //Aqui podemos manejar todo el acceso al controlador, podemos meter seguridad tipo sesion
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access'=>[
                    'class'=>AccessControl::className(),
                    'rules'=>[
                        [
                            'allow'=>true,
                            'roles'=>['@']
                        ]
                    ]
                ]
                ,
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Libro models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LibroSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Libro model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Libro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Libro();

        $this->subirFoto($model);

        // if ($this->request->isPost) {
        //     if ($model->load($this->request->post()) && $model->save()) {
        //         return $this->redirect(['view', 'id' => $model->id]);
        //     }
        // } else {
        //     $model->loadDefaultValues();
        // }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Libro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // simplemente buscamos el modelo correcto, y subimos la imagen de nuevo, y hacemos el update
        $this->subirFoto($model);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Libro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //asignamos el contenido a un modelo
        $model=$this->findModel($id);
        //vemos si contiene una imagen, file_exists es una instruccion para ver si existe ese archivo
        if(file_exists($model->img)){
            //eliminamos la img
            unlink($model->img);
        }       
        // borrar de la bd
        $model->delete();

        return $this->redirect(['index']);
    }

    // para mostrar los libros en una pag publica
    public function actionLista(){

        $model = Libro::find();

        // 4 elementos por pag, y el total count es el total de registros a paginar, en este caso los del modelo
        $pagination= new Pagination([
            'defaultPageSize'=>4,
            'totalCount'=> $model->count()
        ]);

        // ordenamos por el titulo, y los limitamos por la paginacion y el limite de elementos
        $libros= $model->orderBy('titulo')->offset($pagination->offset)->limit($pagination->limit)->all();

        // pasamos los libros y la paginacion hacia la vista
        return $this->render('lista', ['libros'=>$libros, 'pagination'=>$pagination]);

    }

    /**
     * Finds the Libro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Libro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Libro::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function subirFoto(Libro $model){

        //solo preguntamos si es un post
        
        if($this->request->isPost && $model->load($this->request->post()) ){

            // obtener la instancia del archivo subido
            $model->archivo=UploadedFile::getInstance($model,'archivo');

            // Si el modelo valida los campos y es correcta
            if($model->validate()){

                //validamos que el archivo subido este correcto
                if($model->archivo){

                    //vemos si contiene una imagen, file_exists es una instruccion para ver si existe ese archivo
                    if(file_exists($model->img)){
                        //eliminamos la img en caso de q exista
                        unlink($model->img);
                    }  

                    // Esto esta netamente para que no se repita el nombre, se le agrega la fechan en el nombre, y dps la extension
                    $rutaArchivo='uploads/'.time().'_'.$model->archivo->baseName.'.'.$model->archivo->extension;

                    // Si esta informacion ya se logro guardar
                    if($model->archivo->saveAs($rutaArchivo)){

                        //reemplazamos el dato img por rutaarchivo
                        $model->img=$rutaArchivo;
                    }
                }
            }   

            //Si guarda
            if($model->save(false)){
                return $this->redirect(['index']);
            }   
            // old return $this->redirect(['view', 'id' => $model->id]);  
        }
        else{
            
                $model->loadDefaultValues();
                
        }
    }
}
