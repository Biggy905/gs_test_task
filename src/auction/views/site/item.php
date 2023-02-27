<?php

/** @var array $auction */

$cssClassStatus = match ($auction['status']) {
    \common\enums\AuctionStatusEnum::RUN => 'bg-success',
    \common\enums\AuctionStatusEnum::END => 'bg-secondary',
    default => 'bg-info',
};

$statusText = match ($auction['status']) {
    \common\enums\AuctionStatusEnum::RUN => \Yii::t('auctions', 'status.run'),
    \common\enums\AuctionStatusEnum::END => \Yii::t('auctions', 'status.end'),
    default => \Yii::t('auctions', 'status.new'),
};
?>
<div class="row">
    <div class="col-8">
        <div class="card">
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
                <form action="/auction/buy-bet" method="post">
                    <input type="hidden"  name="id_auction" value="<?= \yii\bootstrap5\Html::encode($auction['id']) ?>"/>
                    <input type="hidden"  name="buy_bet" value="50"/>
                    <input readonly type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/>
                    <button class="btn btn-primary" href="auction/<?= $auction['id'] ?>">Сделать ставку +50руб</button>
                </form>
            </div>
        </div>
    </div>
</div>
