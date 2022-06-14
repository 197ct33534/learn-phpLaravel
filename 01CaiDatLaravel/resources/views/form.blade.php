<form action="/laptrinh" method="post">
    <input type="text" name="name">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <button type="submit" name="submit">submit</button>
</form>