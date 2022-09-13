@extends('layouts.admin')

@section('title', 'Sửa người dùng')
@section('content')
    @if ($errors->any())
        <div class="text-center alert alert-danger"> Vui lòng kiểm tra dữ liệu nhập vào</div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cập nhật thông tin người dùng</h1>
    </div>
    <form action="{{ route('admin.users.postedit', $user) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nameUser">Họ và tên</label>
            <input name="name" type="text" class="form-control" id="nameUser" value="{{ old('name') ?? $user->name }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror (session('name'))

        </div>
        <div class="form-group">
            <label for="emailUser">Email</label>
            <input type="email" name="email" class="form-control" id="emailUser"
                value="{{ old('email') ?? $user->email }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror (session('name'))
        </div>
        <div class="form-group">
            <label for="passwordUser">Mật khẩu (không nhập nếu không mún đổi mật khẩu)</label>
            <input type="password" name="password" class="form-control" id="passwordUser">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror (session('name'))
        </div>
        <div class="form-group">
            <label for="groupsUser">Nhóm người dùng</label>
            <select class="form-control" id="groupsUser" name="group_id">
                <option value="0"">Chọn nhóm người dùng</option>
                @if ($groupList->count() > 0)
                    @foreach ($groupList as $group)
                        <option value='{{ $group->id }}'
                            {{ $user->group_id == $group->id || old('group_id') == $group->id ? 'selected' : false }}>
                            {{ $group->name }}</option>
                    @endforeach
                @endif

            </select>
            @error('group_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror (session('name'))
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection('content')
