<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form of `common\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author', 'sentence_count'], 'integer'],
            [['body', 'title'], 'safe'],
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
     * Search at the index page
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find()->with('author0');
        $sentenceCount = $params['sentence_count'] ?? '';
        $keyword = $params['keyword'] ?? '';
        $searchMethod = $params['search_mode'] ?? 'or';
        // if keyword is present then add search by keyword
        $query = ($keyword) ? $query->byKeyword($keyword) : $query;

        if ($sentenceCount) {
            if ($searchMethod === 'and') {
                $query = $query->andWhere(['sentence_count' => $sentenceCount]);
            } else {
                $query = $query->orWhere(['sentence_count' => $sentenceCount]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}
