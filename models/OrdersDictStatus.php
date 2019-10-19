<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders_dict_status".
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property string $text_color
 * @property int $parent_id
 * @property string $alias
 */
class OrdersDictStatus extends \yii\db\ActiveRecord
{
    public $data;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_dict_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text_color', 'parent_id'], 'required'],
            [['parent_id'], 'integer'],
            [['name', 'color', 'text_color', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'color' => 'Color',
            'text_color' => 'Text Color',
            'parent_id' => 'Parent ID',
            'alias' => 'Alias',
        ];
    }

    public function getChildren()
    {
        return $this->hasMany(OrdersDictStatus::className(), ['id' => 'parent_id'])->from(['children' => OrdersDictStatus::tableName()]);
    }

    public function getParent($parent_id = 0, $level = "")
    {
        $result = OrdersDictStatus::find()->asArray()->all();

        foreach ($result as $key=>$value) {
            if($value['parent_id'] == 0) {
                $level = "";
            } else {
                $level .= "-";
            }
            $this->data[$value["id"]] = $level.$value["name"];
        }
        return $this->data;
    }
    public function getParentName($parent_id)
    {
        $result = OrdersDictStatus::find()->asArray()->where(['id'=>$parent_id])->one();;

        return $result['name'];
    }
}
