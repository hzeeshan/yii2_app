<?php

namespace app\models;
use yii\base\Model;

class ImportData extends Model
{

    public $file;

    public function rules(){
        return [
            [['file', 'type'],'required'],
            [['file'],'file','extensions'=>'csv','maxSize'=>1024 * 1024 * 5],
        ];
    }

    public function attributeLabels(){
        return [
            'file'=>'Select File',
            'type' => 'Select Type'
        ];
    }
}