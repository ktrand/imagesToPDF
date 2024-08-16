<?php

namespace app\controllers;

use app\models\Image;
use Mpdf\Mpdf;
use Yii;
use yii\base\Controller;

class PdfController extends Controller
{
    /**
     * @return void
     * @throws \Mpdf\MpdfException
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $images = Image::find()->where(['batch_token' => $session->get('batch_token')])->all();
        shuffle($images);
        $pdf = new Mpdf();
        $html = $this->generatePdfHtml($images);
        $pdf->WriteHTML($html);

        $pdf->Output('images.pdf', 'D');
        $session->destroy();
    }

    /**
     * @param $images
     * @return string
     */
    private function generatePdfHtml($images)
    {
        $html = '';
        $imagesPerPage = rand(1, 4);
        $currentPageImages = [];
        $pageCounter = 0;

        foreach ($images as $image) {
            $currentPageImages[] = $image;
            $pageCounter++;
            if ($pageCounter >= $imagesPerPage) {
                $html .= $this->renderPage($currentPageImages);
                $html .= '<div style="page-break-before: always;"></div>';
                $currentPageImages = [];
                $pageCounter = 0;
                $imagesPerPage = rand(1, 4);
            }
        }

        if (!empty($currentPageImages)) {
            $html .= $this->renderPage($currentPageImages);
        }

        return $html;
    }

    /**
     * @param $images
     * @return string
     */
    private function renderPage($images)
    {
        $pageHtml = '';
        $count = count($images);
        $widthPercent = 100 / $count;
        foreach ($images as $image) {
            $pageHtml .= '<img src="' . $image->path . '" width="' . $widthPercent . '%" style="margin: 10px;">';
        }

        return $pageHtml;
    }
}