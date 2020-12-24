<?php

namespace frontend\controllers;

use common\models\NewEmail;
use frontend\models\UpdateEmailForm;
use frontend\models\UpdatePasswordForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\log\Logger;

class SettingsController extends \yii\web\Controller
{

    /** @var NewEmail */
    private $new_email;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update-email' => ['POST'],
                      'confirm-email' => ['GET'],
                    'update-password' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionIndex()
    {
        $model = \Yii::$app->user->identity;
        return $this->render('index', ['model' => $model]);
    }

    public function actionUpdateEmail()
    {
        $model = new UpdateEmailForm();
        $post = \Yii::$app->request->post();
        /* @var $user \common\models\User */
        $user = \Yii::$app->user->identity;
        $model->user = $user;
        $model->load($post);
        // If old email is not valid
        if ($model->old_email !== $user->email) {
            $model->addError('old_email', 'Old email should match with your current email');
            // If new email the same
        } elseif ($model->new_email === $user->email) {
            \Yii::$app->session->setFlash('danger', 'Your new email should not be the same');
        } elseif ($model->validate() && ($email = $model->generateNewEmail())->save() && $email->sendConfirmationMessage()) {
            \Yii::$app->session->setFlash('success','Check your email for further instructions');
        } else {
            \Yii::$app->session->setFlash('danger', 'Sorry, we have internal error');
        }
        $model->new_email = '';
        return $this->renderAjax('_email', ['model' => $model]);
    }

    public function actionUpdatePassword()
    {
        $model = new UpdatePasswordForm();
        $postData = \Yii::$app->request->post();
        /* @var $user \common\models\User */
        $user = \Yii::$app->user->identity;
        $model->load($postData);
        if ($model->old_password && $user->validatePassword($model->old_password)) {
            if ($model->validate()) {
                $user->setPassword($model->new_password);
                $user->save() ?
                    \Yii::$app->session->setFlash('success', 'Password updated successfully'):
                    \Yii::$app->session->setFlash('danger', 'Sorry, we have internal error');
            }
        } else {
            $model->addError('old_password', 'Password is not valid');
        }
        $model->clear();
        return $this->render('_password', ['model' => $model]);
    }

    public function actionConfirmEmail($token)
    {
        $email = NewEmail::findOne(['token' => $token]);
        $user = $email->user;
        $user->email = $email->email;
        if ($user->save()) {
            \Yii::$app->session->setFlash('success', 'Your email has been changed!');
            $email->delete();
        } else {
            \Yii::$app->session->setFlash('error', 'Sorry, we are unable to change your email with provided token.');
        }
        return $this->goHome();
    }
}
