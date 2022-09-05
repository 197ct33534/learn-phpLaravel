<h1>trang dành cho bác sĩ</h1>

<a href="{{ route('doctors.logout') }}"
    onclick="event.preventDefault(); document.querySelector('#logout-form').submit();">Đằng xuất</a>

<form method="post" id="logout-form" action="{{ route('doctors.logout') }}">@csrf</form>
