<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/4/25
 * Time: 23:05
 */
use yii\helpers\Url;

?>

<link rel="stylesheet" href="<?= Url::to('@web/static/orderFlow/css/index.css') ?>">
<link rel="stylesheet" href="<?= Url::to('@web/static/orderFlow/css/common.css') ?>">
<link rel="stylesheet" href="<?= Url::to('@web/static/orderFlow/css/page.css') ?>">

<div class="percentage">
    <div class="search_dd2">
        <input type="text" maxlength="20" id="queryOrder" placeholder="搜索订单名称或客户姓名" value="">
        <img onclick="window.list.search();" src="<?= Url::to('@web/static/orderFlow/images/search-blue.png') ?>">
    </div>
    <div class="ddzx_mes">
        <table class="newTab">

            <thead>
            <tr>
                <th colspan="3" class="clooseColor">订单编号</th>
                <th colspan="5">订单名称</th>
                <th colspan="4">收货人信息</th>
                <th colspan="3">更新时间</th>
                <th colspan="3" class="tab-caozuo">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($list)): ?>
                <?php foreach ($list as $item): ?>
                    <tr>
                        <td colspan="3"><?=$item['order_sn']?></td>
                        <td colspan="5"><?=$item['order_name']?></td>
                        <td colspan="4"><?=$item['consignee_name']?> - <?=$item['consignee_phone']?></td>
                        <td colspan="3"><?=date('Y-m-d H:i:s',$item['up_time']);?></td>
                        <td colspan="3">
                            <a href="<?=Url::toRoute(['/order-flow/order/create','id' => $item['id']])?>">编辑</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
        <!-- 没有数据时显示 -->
        <?php if (empty($list)): ?>
            <img class="null-content" src="<?= Url::to('@web/static/orderFlow/images/null-content.png') ?>">
            <div class="null-msg">订单已清空</div>
        <?php endif; ?>
    </div>
</div>

<?php
$this->registerJsFile(Url::to('@web/static/js/layer-3.1.1/dist/layer.js'), ['depends' => 'dmstr\web\AdminLteAsset']);
$this->registerJsFile(Url::to('@web/static/orderFlow/js/list.js'), ['depends' => 'dmstr\web\AdminLteAsset']);
?>

<script type="application/javascript">
    <?php $this->beginBlock('footer_js'); ?>
    <?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['footer_js'], \yii\web\View::POS_LOAD); ?>
