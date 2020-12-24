<?php


namespace frontend\models;


class UpdatePasswordForm extends \yii\base\Model
{
    public $old_password;
    public $new_password;
    public $new_password_repeat;

    public function rules()
    {
        return [
            [['old_password', 'new_password', 'new_password_repeat'], 'required', 'message' => 'This field cannot be blank'],
            ['new_password', 'string', 'min' => \Yii::$app->params['user.passwordMinLength']],
            ['new_password_repeat', 'compare', 'compareAttribute' => 'new_password']
        ];
    }

    public function clear()
    {
        $this->old_password = null;
        $this->new_password = null;
        $this->new_password_repeat = null;

    }
}