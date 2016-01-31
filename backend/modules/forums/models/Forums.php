<?php

namespace backend\modules\forums\models;

use Yii;

/**
 * This is the model class for table "forums".
 *
 * @property integer $id
 * @property string $text
 * @property integer $username
 */
class Forums extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forums';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'username'], 'required'],
            [['text'], 'string'],
            [['username'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'username' => 'Username',
        ];
    }
}
