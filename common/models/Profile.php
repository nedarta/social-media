<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $user_id
 * @property string|null $description
 * @property string|null $status
 * @property string|null $avatar
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['description', 'status', 'avatar'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['status' ,'default', 'value' => 'Hello, I\' new here']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'description' => 'Description',
            'status' => 'Status',
            'avatar' => 'Avatar',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }

    /**
     * setting default avatar to model
     */
    public function setDefaultAvatar()
    {
        $this->avatar = Yii::getAlias('@avatarsWebPath') . '/' . Yii::$app->params['profile.defaultAvatar'];
    }

    /**
     * Removing avatar if it's not default
     *
     * @return bool
     */
    public function removeAvatarFile()
    {
        $filename = \Yii::getAlias('@avatarsLocalPath') . '/' . basename($this->avatar);
        return $this->isAvatarDefault() || file_exists($filename) && unlink($filename);
    }

    /**
     * @return bool
     */
    public function isAvatarDefault()
    {
        return $this->avatar === Yii::getAlias('@avatarsWebPath') . '/' . Yii::$app->params['profile.defaultAvatar'];
    }
}
