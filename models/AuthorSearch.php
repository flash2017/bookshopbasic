<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Author;

/**
 * AuthorSearch represents the model behind the search form of `app\models\Author`.
 */
class AuthorSearch extends Author
{
    public ?string $author_name;

    public function init(): void
    {
        $this->author_name = null;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['author_name'], 'string', 'skipOnEmpty' => false],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Author::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        $query->orFilterWhere(['like', 'first_name', $this->author_name])
            ->orFilterWhere(['like', 'last_name', $this->author_name])
            ->orFilterWhere(['like', 'second_name', $this->author_name]);

        return $dataProvider;
    }
}
