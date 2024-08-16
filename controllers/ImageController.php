<?php

namespace app\controllers;

use app\models\Image;
use Yii;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\UploadedFile;

class ImageController extends Controller
{
    /**
     * @throws Exception
     */
    public function actionUpload()
    {
        $response = [
            'error' => '',
        ];
        if (Yii::$app->request->isPost) {
            $files = UploadedFile::getInstancesByName('images');
            if (0 < count($files) && count($files) <= 10) {
                $batchToken = bin2hex(random_bytes(8)) . time();
                $session = Yii::$app->session;
                $session->set('batch_token', $batchToken);
                foreach ($files as $file) {
                    if ($file->size < 5 * 1024 * 1024 &&
                        in_array($file->extension, ['jpg', 'jpeg', 'png'])) {
                        $path = Yii::getAlias('@webroot/uploads/');
                        $fileName = uniqid() . '.' . $file->extension;
                        $file->saveAs($path . $fileName);

                        $image = new Image();
                        $image->name = $fileName;
                        $image->path = $path . $fileName;
                        $image->batch_token = $batchToken;
                        $image->created_at = date('Y-m-d H:i:s');
                        $image->save();
                    } else {
                        $response['error'] = 'Недопустимый формат или размер файла.';
                    }
                }
            } else {
                $response['error'] = 'Недопустимое число фотографий(допустимое кол. 0 - 10).';
            }
        }

        return json_encode($response);
    }
}