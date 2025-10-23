<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;
use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;

/**
 * TopAuthorSearch represents the model behind the search form of `app\models\Book`.
 */
class TopAuthorSearch extends Model
{
    public $year_of_publication;
    public $author_id;
    public $first_name;
    public $last_name;
    public $second_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year_of_publication','author_id'], 'integer'],
            [['author_id'], 'default', 'value' => null],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @return ArrayDataProvider
     */
    public function search(): ArrayDataProvider
    {
        $query = LnkBookAuthors::find()->select('first_name, last_name, second_name, author_id, count(book_id) as cnt')
            ->joinWith('author')
            ->joinWith('book')
            ->groupBy(['first_name', 'last_name', 'second_name', 'author_id'])
            ->orderBy(['cnt' => SORT_DESC]);


        $this->validate() ?
            $query->andFilterWhere(['year_of_publication' => $this->year_of_publication]) :
            $query->where('0=1');
        // grid filtering conditions
        $data = $query->all();
        $allModels = [];

        foreach ($data as $k => $item) {
            $itemAuthor = $item->getAuthor()->one();
            $allModels[$k] = [
                'author_id' => $item->author_id,
                'first_name' => $itemAuthor->first_name,
                'last_name' => $itemAuthor->last_name,
                'second_name' => $itemAuthor->second_name
            ];
        }

        return new ArrayDataProvider(
            ['allModels' => $allModels,
                'pagination' => [
                    'pageSize' => 10,
                ]
            ]);

        return $dataProvider;
    }
}
