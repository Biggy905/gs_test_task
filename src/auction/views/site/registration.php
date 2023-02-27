<div class="container">
    <div class="row">
        <div class="col-6">
            <form action="<?= \yii\helpers\Url::to('/registration');?>" method="post">
                <div class="mb-3">
                    <label for="first_name" class="form-label">Имя</label>
                    <input type="text" name="first_name" class="form-control" id="first_name">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Фамилия</label>
                    <input type="text" name="last_name"  class="form-control" id="last_name">
                </div>
                <input readonly type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/>
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
            </form>
        </div>
    </div>
</div>
