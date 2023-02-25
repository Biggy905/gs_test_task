<?php

/** @var yii\web\View $this */
/** @var array $auctions */

$this->title = 'Auction list';
?>
<div class="container">
    <div class="row g-2">
        <div class="col-12">
            <h1 class="text-center">Скандинавский аукцион</h1>
        </div>
        <?php foreach($auctions as $auction) {
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
            <div class="col-4 card">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header <?= $cssClassStatus?>">
                            <h2><?= \yii\bootstrap5\Html::encode($auction['name'])?></h2>
                        </div>
                        <div class="card-body">
                            <p class="text-center <?= $cssClassStatus?>">
                                <?= $statusText?>
                            </p>
                            <h4>
                                <small>Продукт: </small><?= \yii\bootstrap5\Html::encode($auction['product'])?>
                            </h4>
                            <h4>
                                <small>Категория: </small><?= \yii\bootstrap5\Html::encode($auction['category'])?>
                            </h4>
                            <p>
                                Старт: <?= \yii\bootstrap5\Html::encode($auction['start_time'])?>
                                <?= \yii\bootstrap5\Html::encode($auction['start_date'])?>
                            </p>
                            <p>
                                Конец: <?= \yii\bootstrap5\Html::encode($auction['end_time'])?>
                                <?= \yii\bootstrap5\Html::encode($auction['end_date'])?>
                            </p>
                            <p>
                                Кто ведет: <?= \yii\bootstrap5\Html::encode($auction['full_name'])?>
                            </p>
                            <p>
                                Создан: <?= \yii\bootstrap5\Html::encode($auction['created_at'])?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="<?= \yii\bootstrap5\Html::encode($auction['id'])?>">Сделать ставку</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>

<div class="modal" tabindex="-1" id="user-register">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Зарегиструй меня!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="user-input">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    const myModal = document.getElementById('user-register');
    const myInput = document.getElementById('user-input');

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus();
    })
</script>

<script>
    var conn = new WebSocket('ws://localhost:3200/websocket');
    conn.onopen = function(e) { console.log("Connection established!"); };
    console.log(conn.onopen);
</script>
