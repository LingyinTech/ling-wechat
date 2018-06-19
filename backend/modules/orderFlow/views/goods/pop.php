<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/24
 * Time: 23:46
 */
use yii\helpers\Url;

?>

<link rel="stylesheet" href="<?= Url::to('@web/static/orderFlow/css/index.css') ?>">
<link rel="stylesheet" href="<?= Url::to('@web/static/orderFlow/css/common.css') ?>">
<link rel="stylesheet" href="<?= Url::to('@web/static/orderFlow/css/city-picker.css') ?>" type="text/css">

<div class="styleTank" style="display: block;">
    <div class="styleTankance">
        <div class="search_dd tank_dd">
            <span>选择款式</span>
            <div class="search_dd_input">
                <input type="text" maxlength="30" name="style" placeholder="款式名称">
                <img id="queryStyle" src="<?= Url::to('@web/static/orderFlow/images/search-blue.png') ?>">
                <ul class="order-drop-down" style="display: none;"></ul>
            </div>

        </div>
        <div class="fixedKuang">
            <table class="newTab" id="orderTable">
                <thead>
                <tr>
                    <th colspan="9">款式名称</th>
                    <th class="clooseColor" colspan="6"></th>
                    <th colspan="3" class="tab-caozuo">选择</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($list)): ?>
                    <?php foreach ($list as $goods): ?>
                        <tr onclick="selectGoods(<?=$goods['id'] ?>,<?=$index?>,'<?=$goods['name']?>')">
                            <td colspan="9"><p class="tab-ellipsis"><?=$goods['name']?></p></td>
                            <td colspan="6">自营大源仓库</td>
                            <td colspan="3"><span class="col btn-text">选择</span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
            <div id="kuanshi-null"></div>
        </div>
        <!-- 页码加在这里 -->
        <div id="order_pager"></span>
        </div>
    </div>
</div>


<script type="application/javascript">
    function selectGoods(goodsId, i, goodsName) {
        window.parent.order.selectGoods(goodsId, i, goodsName);
    }
</script>