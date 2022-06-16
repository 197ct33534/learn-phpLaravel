<form action="/devnghia" method="post">
    <input type="text" name='name'>
    <!-- custom method -->
    <input type="hidden" name="_method" value="patch">
    <input type="hidden" name="_token" value=<?= csrf_token()?> >
    <button type="submit" name="submit">submit</button>
</form>