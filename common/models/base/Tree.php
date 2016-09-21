<?php

namespace common\models\base;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
/**
 * This is the model class for table "base_tree".
 *
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $lvl
 * @property string $name
 * @property string $slug
 * @property string $link
 * @property string $description
 * @property string $icon
 * @property integer $icon_type
 * @property integer $active
 * @property integer $selected
 * @property integer $disabled
 * @property integer $readonly
 * @property integer $visible
 * @property integer $collapsed
 * @property integer $movable_u
 * @property integer $movable_d
 * @property integer $movable_l
 * @property integer $movable_r
 * @property integer $removable
 * @property integer $removable_all
 * @property string $created
 * @property string $updated
 */
class Tree extends \kartik\tree\models\Tree {

    const ROOT = null;

    /**
     * @var array the default list of boolean attributes with initial value = `false`
     */
    public static $falseAttribs = [
        'selected',
        'disabled',
        'readonly',
        'collapsed',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'base_tree';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['root'], 'default', 'value' => static::ROOT],
            [['name'], 'required'],
            [['slug'], 'match', 'pattern' => static::SLUG_PATTERN],
            [['slug'], 'unique', 'targetAttribute' => ['slug', 'root']],
            [['active'], 'default', 'value' => 1],
            [['root', 'lft', 'rgt', 'lvl', 'icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all'], 'integer'],
            [['description'], 'string'],
            //[['link'], 'url'],
            [['name', 'slug', 'link', 'icon'], 'string', 'max' => 255],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'root' => 'Root',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'lvl' => 'Lvl',
            'name' => 'Name',
            'slug' => 'Slug',
            'link' => 'Link',
            'description' => 'Description',
            'icon' => 'Icon',
            'icon_type' => 'Icon Type',
            'active' => 'Active',
            'selected' => 'Selected',
            'disabled' => 'Disabled',
            'readonly' => 'Readonly',
            'visible' => 'Visible',
            'collapsed' => 'Collapsed',
            'movable_u' => 'Movable U',
            'movable_d' => 'Movable D',
            'movable_l' => 'Movable L',
            'movable_r' => 'Movable R',
            'removable' => 'Removable',
            'removable_all' => 'Removable All',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return array_merge_recursive(Base::behaviors(), parent::behaviors(), [
            'SluggableBehavior' => [
                'class' => \yii\behaviors\SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'slug',
                'immutable' => false,
                'ensureUnique' => true,
                'uniqueValidator' => ['targetAttribute' => ['slug', 'root']]
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function find() {
        //Set default condition
        return (new query\Tree(get_called_class()))->andWhere(static::ROOT ? ['root' => static::ROOT] : null)->addOrderBy('root, lft');
    }

    public function beforeDelete() {
        if (parent::beforeDelete()) {
            return !($this->isRoot() && ($this->root == static::ROOT));
        }
        return false;
    }
    
    
    /**
     * @param int $lvl tree level
     * @return array of tree node as id => name
     */
    public static function getList($lvl = 1) {
        //return ArrayHelper::map(static::find()->andWhere(['lvl' => $lvl])->all(), 'id', 'name');
        return static::find()->with('firstMedia')->andWhere(['lvl' => $lvl])->all();
    }
    
    public function getParent() {
        return self::find()
                        ->andWhere(['lvl' => $this->lvl-1])
                        ->andWhere(['<','lft', $this->lft])
                        ->andWhere(['>','rgt', $this->rgt])
                        ->with('firstMedia')
                        ->one();
    }
	
    public function getChildren() {
        return self::find()
                        ->andWhere(['lvl' => $this->lvl+1])
                        ->andWhere(['>','lft', $this->lft])
                        ->andWhere(['<','rgt', $this->rgt])
                        ->with('firstMedia')
                        ->all();
    }
    
    /**
     * Retrieves list of childs grouped by parent name
     * @param int $type
     * @return array
     */
    
    public static function getGroupedList($lvl = 1) {
        $oTree = static::find()->andWhere(['lvl' => $lvl])->all();
        return ArrayHelper::map($oTree, 'id', 'name', function($oTreeNode) {
                    return Html::encode($oTreeNode->getParent()->name);
                });
    }
    
}
