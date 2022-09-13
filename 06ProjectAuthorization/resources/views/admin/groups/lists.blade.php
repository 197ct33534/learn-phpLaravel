@extends('layouts.admin')

@section('title', 'Trang Quản Lí Nhóm Người Dùng')



@section('content')
    @if (session('msg'))
        <div class="text-center alert alert-success">{{ session('msg') }}</div>
    @endif
    @if (session('error'))
        <div class="text-center alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách nhóm người dùng</h1>

    </div>
    <p><a href="{{ route('admin.groups.add') }}"><button class="btn btn-primary">Thêm nhóm người dùng</button></a></p>

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên nhóm</th>
                <th scope="col">Người tạo</th>
                <th scope="col">Phân quyền</th>

                <th scope="col">Sửa</th>
                <th scope="col">Xóa</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($groupList as $idx => $group)
                <tr>
                    <th scope="row">{{ $idx + 1 }}</th>
                    <td>{{ $group->name }}</td>
                    <td>
                        {{ !empty($group->postBy->name) ? $group->postBy->name : false }}
                    </td>
                    <td>
                        <a href="{{ route('admin.groups.permissions', $group) }}"><button class="btn btn-primary">Phân
                                quyền</button></a>
                    </td>
                    <td>
                        <a href="{{ route('admin.groups.edit', $group) }}"><button class="btn btn-warning">Sửa</button></a>
                    </td>
                    <td>
                        @if (Auth::user()->id != $group->id)
                            <a href="{{ route('admin.groups.delete', $group) }}"
                                onclick="return confirm('bạn có chắc chắn xóa ?')"><button
                                    class="btn btn-danger">Xóa</button></a>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection('content')
