<?php

/** @var yii\web\View $this */
/** @var array $auctions */
/** @var array $pagination */

/** @var \yii\web\Session $session */

use yii\widgets\LinkPager;

$this->title = 'Auction list';

$hasSession = $session->session->has('user');
?>
<div class="container">
    <div class="row g-2">
        <div class="col-12">
            <?php if (empty($hasSession)) { ?>
                <a href="<?= \yii\helpers\Url::to('site/registration'); ?>">
                    Регистрация участников
                </a>
            <?php } else { ?>
                <p class="text-info">Вы зашли, под именем <b
                            class="text-success"><?= $session->session->get('user'); ?></b></p>
            <?php } ?>

        </div>
        <div class="col-12">
            <h1 class="text-center">Скандинавский аукцион</h1>
        </div>
        <?php foreach ($auctions as $auction) {
            $cssClassStatus = match ($auction['status']) {
                \common\enums\AuctionStatusEnum::RUN => 'bg-success',
                \common\enums\AuctionStatusEnum::END => 'bg-secondary',
                default => 'bg-info',
            };

            $statusText = match ($auction['status']) {
                \common\enums\AuctionStatusEnum::RUN => \Yii::t('auctions', 'status.run'),
                \common\enums\AuctionStatusEnum::END => \Yii::t('auctions', 'status.end'),
                default => \Yii::t('auctions', 'status.new'),
            }; ?>
            <div class="col-4">
                <div class="row">
                    <div class="col-12 card">
                        <div class="card-header <?= $cssClassStatus ?>">
                            <h2><?= \yii\bootstrap5\Html::encode($auction['name']) ?></h2>
                        </div>
                        <div class="card-body">
                            <p class="text-center <?= $cssClassStatus ?>">
                                <?= $statusText ?>
                            </p>
                            <h4>
                                <small>Продукт: </small><?= \yii\bootstrap5\Html::encode($auction['product']) ?>
                            </h4>
                            <h4>
                                <small>Категория: </small><?= \yii\bootstrap5\Html::encode($auction['category']) ?>
                            </h4>
                            <p>
                                Старт: <?= \yii\bootstrap5\Html::encode($auction['start_time']) ?>
                                <?= \yii\bootstrap5\Html::encode($auction['start_date']) ?>
                            </p>
                            <p>
                                Конец: <?= \yii\bootstrap5\Html::encode($auction['end_time']) ?>
                                <?= \yii\bootstrap5\Html::encode($auction['end_date']) ?>
                            </p>
                            <p>
                                Кто ведет: <?= \yii\bootstrap5\Html::encode($auction['full_name']) ?>
                            </p>
                            <p>
                                Создан: <?= \yii\bootstrap5\Html::encode($auction['created_at']) ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-primary" href="auction/<?= $auction['id']?>">Сделать ставку</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="pagination justify-content-center">
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'registerLinkTags' => true,
                'options' => [
                    'class' => 'pagination'
                ],
                'maxButtonCount' => 3,
                'linkOptions' => [
                    'class' => 'page-link',
                ],
                'pageCssClass' => 'page-item',
                'prevPageCssClass' => 'page-item',
                'nextPageCssClass' => 'page-item',
            ]); ?>
        </div>
    </div>
</div>

<script>
    var conn = new WebSocket('ws://localhost:3200/websocket');
    conn.onopen = function (e) {
        console.log("Connection established!");
    };
    console.log(conn.onopen);
</script>
