<?php

namespace app\models\user;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 */
class UserRecord extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'auth_key'], 'required'],
            [['username', 'password', 'auth_key'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['auth_key'], 'unique'],
        ];
    }

    public function init() {
        if ($this->isNewRecord) {
            $this->auth_key = $this->authKeyDefault();
        }
        parent::init();
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    private function authKeyDefault(): string
    {
        return Yii::$app->security->generateRandomString(32);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert): bool
    {
        $output = parent::beforeSave($insert);

        if ($this->isAttributeChanged('password')) {
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }

        return $output;
    }

    public function afterSave($insert, $changedAttributes)
    {

    }

    /**
     * @param int $id
     * @return UserRecord|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @param string $token
     * @param string|null $type
     * @return UserRecord|IdentityInterface|null
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }
}
