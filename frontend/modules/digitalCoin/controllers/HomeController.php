<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/2/4
 * Time: 1:30
 */

namespace frontend\modules\digitalCoin\controllers;


use common\base\api\Controller;
use common\modules\digitalCoin\models\CoinDesc;

class HomeController extends Controller
{

    public function actionList()
    {
        $page = app()->request->get('page', 1);
        $filter['limit'] = app()->request->get('page_size', 20);
        $filter['offset'] = ($page - 1) * $filter['limit'];
        $filter['status'] = 1;
        $filter['orderBy'] = 'sort desc,id asc';

        if($list = (new CoinDesc())->getList($filter)){
            foreach ($list as &$item){
                $item['content'] = str_replace(PHP_EOL,"\n",$item['content']);
            }
        }
        $data['list'] = $list;
        $data['status'] = empty($list) ? 1 : 0;
        return $this->format($data);
    }

}