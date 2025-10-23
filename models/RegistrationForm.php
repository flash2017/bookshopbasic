<?php

namespace app\models;

use app\models\user\UserRecord;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegistrationForm extends Model
{
    public ?string $username = null;
    public ?string $password = null;
    private ?UserRecord $_user = null;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            ['username', 'unique', 'targetClass' => UserRecord::class, 'targetAttribute' => 'username'],
            ['password','string', 'max' => 16, 'min' => 6],
        ];
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function save(): bool
    {
        $userRecord = $this->getUser();
        $userRecord->save();

        /** @var \yii\rbac\DbManager $rbac */
        $rbac = \Yii::$app->authManager;

        $rbac->assign(
            $rbac->getRole('user'),
            $userRecord->getPrimaryKey()
        );

        return true;
    }

    private function getUser(): UserRecord
    {
        if ($this->_user === null) {
            $this->_user = new UserRecord();
            $data = ['UserRecord' => ['username' => $this->username, 'password' => $this->password]];
            $this->_user->load($data);
            $this->_user->validate();
        }

        return $this->_user;
    }
}
