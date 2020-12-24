<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Model to change email
 *
 * @property int $user_id
 * @property string $email
 * @property string $token
 * @property int $created_at
 *
 * @property User $user
 */
class NewEmail extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%new_email}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'email', 'token'], 'required'],
            [['user_id'], 'integer'],
            [['email', 'token'], 'string', 'max' => 255],
            [['token'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                // leave only created_at
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' =>  false,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'email' => 'Email',
            'token' => 'Token',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    /**
     * Creates random token to confirm email, assigns it to the model and returns it
     *
     * @return string
     */
    public function generateConfirmationToken()
    {
        return $this->token = \Yii::$app->security->generateRandomString(128);
    }

    /**
     * Sending message to confirm email update
     *
     * @return bool
     */
    public function sendConfirmationMessage()
    {
        return \Yii::$app
            ->mailer
            ->compose(
                ['html' => 'confirmEmail-html', 'text' => 'confirmEmail-text'],
                ['model' => $this]
            )
            ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
            ->setTo($this->user->email)
            ->setSubject('Email update at ' . \Yii::$app->name)
            ->send();
    }
}
