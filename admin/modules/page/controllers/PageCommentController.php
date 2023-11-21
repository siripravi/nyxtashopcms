<?php
/**
 * Project: yii2-page for internal using
 * Author: common\modules
 * Copyright (c) 2018.
 */

namespace admin\modules\page\controllers;

use admin\modules\page\models\pageComment;
use admin\modules\page\models\pageCommentSearch;
use admin\modules\page\Module;
use admin\modules\page\traits\IActiveStatus;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class PageCommentController extends BaseAdminController
{
    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageCommentSearch();
        $searchModel->scenario = PageCommentSearch::SCENARIO_ADMIN;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comment model.
     * @param string $id
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
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = pageComment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new pageComment();
        $model->scenario = pageComment::SCENARIO_ADMIN;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = PageComment::SCENARIO_ADMIN;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Mass action with comment
     *
     * @return \yii\web\Response
     */
    public function actionBulk()
    {
        $action = Yii::$app->request->post('action');
        $selection = (array)Yii::$app->request->post('selection');//typecasting
        switch ($action) {
            case 'd':
                if ($this->deleteAll($selection)) {
                    $message = Yii::t('page', 'Successfully delete');
                }
                break;
            case 'c':
                if ($this->confirmAll($selection)) {
                    $message = Yii::t('page', 'Successfully confirm');
                }
                break;
            default:
                $message = Yii::t('page', 'Action not found');
        }

        Yii::$app->session->setFlash('warning', $message);

        return $this->redirect('index');
    }

    /**
     * @param $selection
     * @return int
     */
    private function deleteAll($selection)
    {
        return pageComment::deleteAll(['id' => $selection]);
    }

    /**
     * @param $selection
     * @return int
     */
    private function confirmAll($selection)
    {
        return pageComment::updateAll(['status' => IActiveStatus::STATUS_ACTIVE], ['id' => $selection]);
    }
}
