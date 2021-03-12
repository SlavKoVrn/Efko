<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%vacation}}".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $fixed
 * @property string|null $from
 * @property string|null $to
 * @property string|null $title
 */
class Vacation extends \yii\db\ActiveRecord
{
    const NOT_FIXED=0;
    const FIXED=1;

    public function load($data, $formName = null)
    {
        if (isset($data['Vacation']['from'])){
            $data['Vacation']['from']=date('Y-m-d 00:00:00',strtotime($data['Vacation']['from']));
        }
        if (isset($data['Vacation']['to'])){
            $data['Vacation']['to']=date('Y-m-d 23:59:59',strtotime($data['Vacation']['to']));
        }
        return parent::load($data, $formName);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vacation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'fixed'], 'integer'],
            [['from', 'to', 'title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['from','to'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['from'], 'dateFrom'],
            [['to'], 'dateTo'],
        ];
    }

    public function dateFrom($attribute) {
        $from=strtotime($this->$attribute);
        $now=strtotime(date('d.m.Y 00:00:00',time()));
        if ($from < $now){
            $this->addError($attribute,  'Дата начала не может быть меньше текущей');
        }
    }

    public function dateTo($attribute) {
        $from=strtotime($this->from);
        $to=strtotime($this->to);
        if ($from > $to){
            $this->addError($attribute,  'Дата конца не может быть меньше даты начала');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Отпускник',
            'fixed' => 'Зафиксировано',
            'from' => 'Дата начала отпуска',
            'to' => 'Дата конца отпуска',
            'title' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
