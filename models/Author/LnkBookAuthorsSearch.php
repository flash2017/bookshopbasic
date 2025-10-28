<?php

namespace app\models\Author;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

/**
 * LnkBookAuthorsSearch represents the model behind the search form of `app\models\LnkBookAuthors`.
 */
class LnkBookAuthorsSearch extends LnkBookAuthors
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'book_id', 'author_id'], 'integer'],
            [['CREATED_AT', 'DELETED_AT'], 'safe'],
 //           [['year'], 'number', 'length' => 4],
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
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = LnkBookAuthors::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'book_id' => $this->book_id,
            'author_id' => $this->author_id,
            'CREATED_AT' => $this->CREATED_AT,
            'DELETED_AT' => $this->DELETED_AT,
        ]);

        return $dataProvider;
    }

    /**
     * Поиск самого плодовитого автора по версии БД за год
     * @param int $year
     * @return ArrayDataProvider
     */
    public function searchByYear(int $year): ArrayDataProvider
    {
        /*
         *   SELECT lnkba.author_id, count(lnkba.book_id)
             FROM lnk_book_authors lnkba join yii2basic.book b on b.id = lnkba.book_id
             WHERE year_of_publication = 1992
             GROUP BY lnkba.author_id ;
          * */

        $data = self::find()->select('FIRST_NAME, LAST_NAME, SECOND_NAME, author_id, count(book_id) as cnt')
            ->joinWith('author')
            ->joinWith('book')
            ->where(['year_of_publication' => $year])
            ->groupBy(['FIRST_NAME', 'LAST_NAME', 'SECOND_NAME', 'author_id'])
            ->orderBy(['cnt' => SORT_DESC])
            ->all();
        $allModels = [];

        foreach ($data as $k => $item) {
            $itemAuthor = $item->getAuthor()->one();
            $allModels[$k] = [
                'author_id' => $item->author_id,
                'firstName' => $itemAuthor->FIRST_NAME,
                'lastName' => $itemAuthor->LAST_NAME,
                'secondName' => $itemAuthor->SECOND_NAME
            ];
        }

      return new ArrayDataProvider(
            ['allModels' => $allModels,
                'pagination' => [
                    'pageSize' => 10,
                ]
            ]);
    }
}
