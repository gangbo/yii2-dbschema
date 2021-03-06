<?php
/**
 * Created by daigangbo.
 * User: daigangbo daigangbo@gmail.com
 * Date: 5/25/16
 * Time: 18:31
 */

namespace backend\modules\setting\controllers;


use backend\modules\setting\models\DbCollection;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class DbController extends Controller
{

    const DB_CLASS = 'yii\db\Connection';
    private $_dbArray = [
        'db',
        'db_yao_intv',
    ];

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {

        $data = [];
        foreach ($this->_dbArray as $key) {
            /** @var DbCollection $dbCollection */
            $dbCollection = Yii::createObject([
                'class' => DbCollection::className(),
                'name' => $key,
                'db' => Yii::$app->get($key),
            ]);

            $data[] = $dbCollection;
        }
        $provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $provider,
        ]);
    }

    /**
     * @param $dbName
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionView($dbName)
    {
        /** @var DbCollection $model */
        $model = Yii::createObject([
            'class' => DbCollection::className(),
            'name' => $dbName,
            'db' => Yii::$app->get($dbName),
        ]);

        /** @var \yii\db\Connection $db */
        $db = $model->db;
        $tbSchemas = array_map(function ($tbName) use ($db) {
            return $db->schema->getTableSchema($tbName);
        }, $db->schema->tableNames);
        $tableSchemaProvider = new ArrayDataProvider([
            'allModels' => $tbSchemas,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $this->render('view', [
            'model' => $model,
            'tbSchemaProvider' => $tableSchemaProvider,
        ]);
    }

    /**
     * @param string $dbName
     * @param bool|false $tbName
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionRefresh($dbName = 'db', $tbName = false)
    {
        /** @var \yii\db\Connection $db */
        $db = Yii::$app->get($dbName);
        if ($tbName) {
            $db->schema->refreshTableSchema($tbName);
        } else {
            $db->schema->refresh();
        }
        return 'refresh success';
    }


}