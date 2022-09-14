@extends('layouts.admin')

@section('title', 'Trang Quản Lí User')



@section('content')
    @if (session('msg'))
        <div class="text-center alert alert-success">{{ session('msg') }}</div>
    @endif
    @if (session('error'))
        <div class="text-center alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách người dùng</h1>

    </div>
    @can('create', App\Models\User::class)
        <p><a href="{{ route('admin.users.add') }}"><button class="btn btn-primary">Thêm người dùng</button></a></p>
    @endcan

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Họ và tên</th>
                <th scope="col">Email</th>
                <th scope="col">Tên nhóm</th>
                @can('users.edit')
                    <th scope="col">Sửa</th>
                @endcan
                @can('users.delete')
                    <th scope="col">Xóa</th>
                @endcan

            </tr>
        </thead>
        <tbody>

            @foreach ($usersList as $idx => $user)
                <tr>
                    <th scope="row">{{ $idx + 1 }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getGroup->name }}</td>
                    @can('users.edit')
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}"><button class="btn btn-warning">Sửa</button></a>
                        </td>
                    @endcan
                    @can('users.delete')
                        <td>
                            @if (Auth::user()->id != $user->id)
                                <a href="{{ route('admin.users.delete', $user) }}"
                                    onclick="return confirm('bạn có chắc chắn xóa ?')"><button
                                        class="btn btn-danger">Xóa</button></a>
                            @endif
                        </td>
                    @endcan

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection('content')
