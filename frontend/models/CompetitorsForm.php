<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * CompetitorsForm is the model behind the competitors form.
 */
class CompetitorsForm extends Model
{	
  	public $id;
    public $comp1fb;
    public $comp1tw;
    public $comp1insta;
    public $comp1yt;
    public $comp1gp;
    
    public $comp2fb;
    public $comp2tw;
    public $comp2insta;
    public $comp2yt;
    public $comp2gp;
    
    public $comp3fb;
    public $comp3tw;
    public $comp3insta;
    public $comp3yt;
    public $comp3gp;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // id is required
            [['comp1fb', 'comp1tw', 'comp1insta', 'comp1yt', 'comp1gp', 'comp2fb', 'comp2tw', 'comp2insta', 'comp2yt', 'comp2gp', 'comp3fb', 'comp3tw', 'comp3insta', 'comp3yt', 'comp3gp'], 'url']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comp1fb' => 'Facebook',
            'comp1tw' => 'Twitter',
            'comp1insta' => 'Instagram',
            'comp1yt' => 'Youtube',
            'comp1gp' => 'Google+',
            'comp2fb' => 'Facebook',
            'comp2tw' => 'Twitter',
            'comp2insta' => 'Instagram',
            'comp2yt' => 'Youtube',
            'comp2gp' => 'Google+',
            'comp3fb' => 'Facebook',
            'comp3tw' => 'Twitter',
            'comp3insta' => 'Instagram',
            'comp3yt' => 'Youtube',
            'comp3gp' => 'Google+',
        ];
    }

}
