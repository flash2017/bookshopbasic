<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $second_name
 * @property string $CREATED_AT
 * @property string|null $UPDATED_AT
 * @property string|null $DELETED_AT
 *
 * @property LnkBookAuthors[] $lnkBookAuthors
 */
class Author extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['second_name', 'updated_at', 'deleted_at'], 'default', 'value' => null],
            [['first_name', 'last_name'], 'required'],
            [['CREATED_AT', 'UPDATED_AT', 'DELETED_AT'], 'safe'],
            [['first_name', 'last_name', 'second_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'second_name' => 'Second Name',
            'CREATED_AT' => 'Created At',
            'UPDATED_AT' => 'Updated At',
            'DELETED_AT' => 'Deleted At',
        ];
    }

    /**
     * Gets query for [[LnkBookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLnkBookAuthors()
    {
        return $this->hasMany(LnkBookAuthors::class, ['author_id' => 'id']);
    }

    public function fullName(): string
    {
        return sprintf('%s %s %s', $this->first_name , $this->last_name, $this->second_name);
    }

}
