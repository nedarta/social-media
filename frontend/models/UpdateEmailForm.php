<?php


namespace frontend\models;


use common\models\NewEmail;
use common\models\User;

/**
 * Class UpdateEmailForm
 * @package frontend\models
 * @var $_user User
 */

class UpdateEmailForm extends \yii\base\Model
{
    public $old_email;
    public $new_email;

    public $user;

    public function rules()
    {
        return [
            [['old_email', 'new_email'], 'trim'],
            [['old_email', 'new_email'], 'required'],
            [['old_email', 'new_email'], 'email'],
            [['old_email', 'new_email'], 'string', 'max' => 255],

            ['new_email',
                'unique',
                'targetClass' => User::class,
                'targetAttribute' => 'email',
                'message' => 'This email address has already been taken.'],
        ];
    }

    /**
     * @return NewEmail
     */
    public function generateNewEmail()
    {
        $model = new NewEmail();
        $model->email = $this->new_email;
        $model->user_id = $this->user->id;
//        $model->created_at = 0;
        $model->generateConfirmationToken();
        return $model;
    }

    /**
     * @param User $user
     * @return static
     */
    public static function fromUser(User $user)
    {
        $model = new static();
        $model->user = $user;
        $model->old_email = $user->email;
        return $model;
    }
}