<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property int $created_at
 * @property string batch_token
 */
class Image extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'path', 'batch_token'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 255],
            [['batch_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'path' => 'Путь',
            'created_at' => 'Создано',
            'batch_token' => 'Batch Token'
        ];
    }
}
