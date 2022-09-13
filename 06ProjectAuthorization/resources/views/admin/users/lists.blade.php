@extends('layouts.admin')

@section('title', 'Trang Quản Lí User')



@section('content')
    @if (session('msg'))
        <div class="text-center alert alert-success">{{ session('msg') }}</div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách người dùng</h1>

    </div>
    <p><a href="{{ route('admin.users.add') }}"><button class="btn btn-primary">Thêm người dùng</button></a></p>

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Họ và tên</th>
                <th scope="col">Email</th>
                <th scope="col">Tên nhóm</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($usersList as $idx => $user)
                <tr>
                    <th scope="row">{{ $idx + 1 }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getGroup->name }}</td>
                    <td>
                        <a href="#"><button class="btn btn-warning">Sửa</button></a>
                    </td>
                    <td>
                        @if (Auth::user()->id != $user->id)
                            <a href="#" onclick="return confirm('bạn có chắc chắn xóa ?')"><button
                                    class="btn btn-danger">Xóa</button></a>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection('content')
