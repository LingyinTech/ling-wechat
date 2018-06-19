<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/30
 * Time: 21:56
 */

namespace common\components;


use Picqer\Barcode\BarcodeGeneratorPNG;
use yii\base\Component;

class BarCode extends Component
{

    /**
     * 生成条码
     *
     * @param $data
     * @param bool $base64
     * @return string
     */
    public function getPNG($data, $base64 = true)
    {
        $generator = new BarcodeGeneratorPNG();
        $tempData = $generator->getBarcode($data, $generator::TYPE_CODE_128, 2, 50);
        if($base64){
            $tempData = base64_encode($tempData);
        }
        return $tempData;
    }

}