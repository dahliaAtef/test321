<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * CompetitorsForm is the model behind the competitors form.
 */
class CompetitorTest extends Model
{	
  	public $compid;
    public $compfb;
    public $comptw;
    public $compinsta;
    public $compyt;
    public $compgp;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // id is required
            [['compfb', 'comptw', 'compinsta', 'compyt', 'compgp'], 'url']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'compfb' => 'Facebook',
            'comptw' => 'Twitter',
            'compinsta' => 'Instagram',
            'compyt' => 'Youtube',
            'compgp' => 'Google+',
        ];
    }

}
