<?php

namespace frontend\controllers;

use common\models\Post;
use common\models\PostSearch;
use common\models\Profile;
use common\models\ProfileForm;
use common\models\User;
use common\models\UserSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ProfileController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'avatar-delete' => ['POST']
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }

    /**
     * Deleting profile
     *
     */
    public function actionDelete()
    {
        /** @var User $user */
        $user = \Yii::$app->user->identity;
        $user->status = $user::STATUS_DELETED;
        \Yii::$app->user->logout();
        if ($user->save()) {
            \Yii::$app->session->setFlash('info', 'Your account have been deleted');
        } else {
            \Yii::$app->session->setFlash('danger', 'Internal error occurred, please try later');
        }
        return $this->goHome();
    }

    /**
     * List all users with the search
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $params = Yii::$app->request->queryParams['UserSearch'] ?? [];
        $queryParams = [];
        if (!empty($params)) {
            $queryParams['username'] = $params['username'] ?? '';
            $queryParams['email'] = $params['email'] ?? '';
        }
        $dataProvider = $searchModel->search(['UserSearch' => $queryParams]);
        $pages = $dataProvider->pagination;
        $pages->pageSize = 10;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pages' => $pages,
        ]);
    }

    /**
     * Updating your profile, except password and email
     *
     * @return string
     */
    public function actionUpdate()
    {
        $profileForm = new ProfileForm();
        $user = Yii::$app->user->identity;
        $request = Yii::$app->request;
        if ( $request->isPost && $profileForm->load($request->post())) {
            $profileForm->user = $user;
            $profileForm->avatarFile = UploadedFile::getInstance($profileForm, 'avatar');
            $profileForm->save();
        } else {
            $profileForm->loadFromUser($user);
        }
        return $this->render('update', ['model' => $profileForm]);
    }

    /**
     * Viewing profile
     *
     * @param $username
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($username)
    {
        $model = $this->findModelByUsername($username);
        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Deleting avatar
     *
     * @return \yii\web\Response
     */
    public function actionAvatarDelete()
    {
        /* @var $profile Profile */
        $profile = \Yii::$app->user->identity->profile;
        $profile->removeAvatarFile();
        $profile->setDefaultAvatar();
        $profile->save();
        return $this->redirect(Url::to(['/profile/update']));
    }


    /**
     * Search model, if it doesn't exist throws 404 error
     *
     * @param $id
     * @return Profile|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } elseif($user = User::findOne($id) !== null) {
            $model = new Profile();
            $model->user_id = $user->id;
            if ($model->save()) {
                return $model;
            }
        }

        throw new NotFoundHttpException('The requested user doesn\'t exist');
    }

    /**
     *
     *
     * @param $username
     * @return Profile
     * @throws NotFoundHttpException
     */
    protected function findModelByUsername($username)
    {
        if ( ($user = User::findOne(['username' => $username])) !== null) {
            if ( !$user->hasProfile()) {
                $model = new Profile();
                $model->user_id = $user->id;
                if ($model->save()) {
                    return $model;
                }
            }
            return $user->profile;
        }

        throw new NotFoundHttpException('This requested user doesn\'t exist');
    }
}
