<h1>Admin dashboard</h1>
@if (Auth::check())
    Xin chào , {{ $userDetail->name }} ! <br />
    ID :{{ $userDetail->id }}
@endif
