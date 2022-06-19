<h1>trang upload file</h1>
<form method="post" action="<?= route('categories.uploadFile'); ?>" enctype="multipart/form-data">

    <input type="file" name="myfile" />
    <?= csrf_field(); ?>

    <button type="submit">submit</button>
</form>
