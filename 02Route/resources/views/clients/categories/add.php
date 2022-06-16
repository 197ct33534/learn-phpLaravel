<h1>trang add categories</h1>
<form method="post" action="<?= route('categories.add');?>">

    <input type="text" name='name' placeholder="thêm catelory">
    <?= csrf_field();?>
    <!-- <input type="hidden" value="<?= csrf_token();?>"> -->
    <button type="submit">submit</button>
</form>