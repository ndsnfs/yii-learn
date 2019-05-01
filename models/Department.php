<?php

namespace app\models;


use app\models\query\DepartmentQuery;

/**
 * This is the model class for table "{{%departments}}".
 *
 * @property int $id
 * @property int $pid
 * @property string $name
 *
 * @property Department $parent
 * @property Department[] $children
 */
class Department extends \yii\db\ActiveRecord
{
    public function fields()
    {
        return [
            'id',
            'name',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%departments}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'default', 'value' => null],
            [['pid'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['pid'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['pid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'name' => 'Name',
        ];
    }

    public function extraFields()
    {
        return [
            'parent',
            'children',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Department::class, ['id' => 'pid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Department::class, ['pid' => 'id']);
    }

    public static function find()
    {
        return new DepartmentQuery(self::class);
    }
}
