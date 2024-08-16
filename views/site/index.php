<h1>Загрузка изображений</h1>

<form id="upload-form" method="post" enctype="multipart/form-data">
    <input type="file" name="images[]" multiple>
    <button type="submit">Загрузить</button>
</form>
<br>
<div class="alert alert-danger" style="display: none" id="error">

</div>

<button type="button" onclick="location.href='<?= yii\helpers\Url::to(['/pdf/index']) ?>'" id="downloadPDFButton" style="display: none">Скачать PDF</button>

<script>
    $(document).ready(function() {
        $('#upload-form').submit(function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            $("#error").hide();
            $("#downloadPDFButton").hide();
            $.ajax({
                url: '<?= yii\helpers\Url::to(['/image/upload']) ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    response = jQuery.parseJSON(response);
                    if (!response.error) {
                        $("#downloadPDFButton").show();
                    } else {
                        $("#error").html(response.error);
                        $("#error").show();
                        $("#downloadPDFButton").hide();
                    }
                },
                error: function (error) {
                    $("#error").html('Что-то пошло не так');
                    $("#downloadPDFButton").hide();
                }
            });
        });
    });
</script>
