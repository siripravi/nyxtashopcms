<?php
/**
 * Project: yii2-page for internal using
 * Author: common\modules
 * Copyright (c) 2018.
 */

namespace admin\modules\page\controllers;

use admin\modules\page\models\Page;
use admin\modules\page\models\pageSearch;
use admin\modules\page\models\Status;
use admin\modules\page\traits\IActiveStatus;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * pagePostController implements the CRUD actions for pagePost model.
 */
class PageController extends BaseAdminController
{
    /**
     * Lists all pagePost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $searchModel->scenario = PageSearch::SCENARIO_ADMIN;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $arrayCategory = Page::getArrayCategory();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'arrayCategory' => $arrayCategory,
        ]);
    }

    /**
     * Displays a single pagePost model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the pagePost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return pagePost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new pagePost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
			

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing pagePost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
           
        if ($model->load(Yii::$app->request->post()) ){   //&& $model->save()) {
            print_r($model->errors); die;
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing pagePost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = IActiveStatus::STATUS_ARCHIVE;
        $model->save();

        return $this->redirect(['index']);
    }
}
