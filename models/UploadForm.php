<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\imagine\Image;


class UploadForm extends Model
{
	public $cover;
	public $carousel;
	public $front;
	public $back;	

	public function rules()
	{
		return [
			[['carousel'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,img,jpg,jpeg,gif', 'maxFiles' => 5],
			[['cover'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,img,jpg,jpeg,gif'],
			[['front'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,img,jpg,jpeg,gif'],
			[['back'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,img,jpg,jpeg,gif'],
		];
	}

 	public function scenarios()
    {
        return [
            'upload' => ['cover', 'carousel'],
            'productUpload' => ['front', 'back'],
        ];
    }

	public function upload()
	{
		if ($this->validate()) {
			$coverName = \Yii::getAlias('@app').'/uploads/a'.date('Ymd').'owen.'.$this->cover->extension;
			$this->cover->saveAs($coverName);

			$re = array();
			$re[] = $coverName;
			foreach ($this->carousel as $file) {
				$fileName = \Yii::getAlias('@app').'/uploads/c'.date('Ymd').'owen'.$file->baseName.'.'.$file->extension;
                $file->saveAs($fileName);
                $re[] = $fileName;
            }

			return $re;
		}else{
			return false;
		}
	}

	public function productUpload()
	{
		
		if ($this->validate()) {
			// var_dump($this->front);
			$frontName = \Yii::getAlias('@app').'/uploads/front'.date('Ymd').'owen.'.$this->front->extension;
			$this->front->saveAs($frontName);
			$backName = \Yii::getAlias('@app').'/uploads/back'.date('Ymd').'owen.'.$this->back->extension;
			$this->back->saveAs($backName);
			$re = array($frontName,$backName);
			return $re;
			// var_dump($re);
		}else{
			return false;
		}
	}
}

?>