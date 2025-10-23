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
class LoginForm extends Model
{
    public string $username;
    public string $password;
    public bool $rememberMe = true;
    private ?UserRecord $_user = null;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            /**@uses self::validatePassword()*/
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if ($this->hasErrors() === false) {
            $user = $this->getUser($this->username);

            if ((!$user || !$this->isCorrectPassword($this->$attribute, $user->password))) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * @param string $userName
     * @return UserRecord|null
     */
    private function getUser(string $userName): ?UserRecord
    {
        if ($this->_user === null) {
            $this->_user = $this->fetchUser($userName);
        }

        return $this->_user;
    }

    /**
     * @param string $userName
     * @return null|UserRecord
     */
    private function fetchUser(string $userName): ?UserRecord
    {
        return UserRecord::findOne(['username' => $userName]);
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    private function isCorrectPassword(string $password, string $hash): bool
    {
        return Yii::$app->security->validatePassword($password, $hash);
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login(): bool
    {
        if ($this->validate() && $this->getUser($this->username) instanceof UserRecord) {
            return Yii::$app->user->login(
                $this->getUser($this->username),
                $this->rememberMe ? 3600*24*30 : 0);
        }

        return false;
    }

}
