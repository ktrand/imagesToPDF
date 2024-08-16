<h1>Загрузка изображений</h1>

<form id="upload-form" method="post" enctype="multipart/form-data">
    <input type="file" name="images[]" multiple>
    <button type="submit">Загрузить</button>
</form>

<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>


<script>
    $(document).ready(function() {
        $('#upload-form').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '<?= yii\helpers\Url::to(['/image/upload']) ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Обработка ответа
                },
                error: function(error) {
                    // Обработка ошибки
                }
            });
        });
    });
</script>
