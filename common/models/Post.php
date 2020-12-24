<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\bootstrap4\Html;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $title
 * @property int $author
 * @property string $body
 * @property int|null $sentence_count
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $author0
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author', 'body'], 'required'],
            [['author', 'sentence_count'], 'integer'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['author'], 'exist', 'skipOnError' => false, 'targetClass' => User::class, 'targetAttribute' => ['author' => 'id']],
        ];
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'author' => 'Author',
            'body' => 'Body',
            'sentence_count' => 'Number of sentences',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getAuthor0()
    {
        return $this->hasOne(User::class, ['id' => 'author']);
    }

    /**
     * {@inheritdoc}
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return (new PostQuery(get_called_class()));
    }

    /**
     * Get author username
     *
     * @return string
     */
    public function getAuthorName()
    {
        return $this->author0->username;
    }

    /**
     * Before save, calculating the number of sentences in the body
     *
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
//        $this->body = Html::encode($this->body);
//        $this->title = Html::encode($this->title);
        $this->calculateSentenceCount();
        return parent::beforeSave($insert);
    }

    /**
     * Calculate number of sentences
     */
    protected function calculateSentenceCount()
    {
        $this->sentence_count = (int) preg_match_all('/[^. ]+?([.?!]|$)/', $this->body);
    }

    /**
     * @param $user
     * @return bool
     */
    public function isAuthor($user)
    {
        return $this->author === $user->getId();
    }
}
