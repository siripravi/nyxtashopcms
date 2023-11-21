<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 11.03.17
 * Time: 23:41
 */

namespace admin\modules\image\controllers;

use admin\modules\image\models\File;
use admin\modules\image\models\Image;
use Yii;
use yii\web\Controller;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @param $name
     * @param $size = big|small|cover|...
     * @throws NotFoundHttpException
     */
    public function actionIndex($size, $name)
    {
        $model = $this->findModel($name);  
      /*  $originalFile = Yii::getAlias(Yii::$app->params['file']['path']) . '/' . $model->file->path . '/' . $model->file->hash . '.' . $model->file->extension;
        
        $file = (file_exists($originalFile)) ?
           Image::resize($model, $size) : Yii::$app->basePath . '/web/image/photo-default.png';
        if ($file) {
            header('Content-Type: ' . $model->file->type);            
            readfile($file);
        } else {           
            throw new NotFoundHttpException('Something Wrong!:');          

        }*/
        if ($file = Image::resize($model, $size)) {
            header('Content-Type: ' . $model->file->type);
            readfile($file);
        } else {
            throw new NotFoundHttpException('Image not found!');
        }
        die();
        
    }

    /**
     * Finds the Page model based on its name value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $name
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name)
    {
        if (($model = Image::findOne(['name' => $name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested image does not exist.');
        }
    }

    public function actionFile($name, $extension)
    {
        $model = File::findOne([
            'name' => $name,
            'extension' => $extension,
            'enabled' => true,
        ]);

        if ($model !== null) {
            $file = Yii::getAlias(Yii::$app->params['file']['path']) . '/' . $model->path . '/' . $model->hash . '.' . $model->extension;
         
            if (file_exists($file)) {
                header('Content-Type: ' . $model->type);
                readfile($file);
            } else {
                throw new NotFoundHttpException('The requested file does not exist.');
            }
        } else {
            throw new NotFoundHttpException('The requested file does not exist.');
        }
        die();
    }
}