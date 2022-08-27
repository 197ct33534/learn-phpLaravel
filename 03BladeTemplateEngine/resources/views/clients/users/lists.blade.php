@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <section>
        <div class="container">
            @if (session('msg'))
                <div class="alert alert-warning">{{ session('msg') }}</div>
            @endif
            <h1>{{ $title }}</h1>
        </div>
        <form action="" method="get" class="mb-3">
            <div class="row">
                <div class="col-3">
                    <select name="group_id" class="form-control" id="">
                        <option value="0">Tất cả nhóm</option>
                        @if (!empty(getAllGroups()))
                            @foreach (getAllGroups() as $item)
                                <option value="{{ $item->id }}"
                                    {{ request()->group_id == $item->id ? 'selected' : false }}>{{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-3">
                    <select name="status" class="form-control" id="">
                        <option value="0">Tất cả trạng thái</option>
                        <option value="active" {{ request()->status === 'active' ? 'selected' : false }}>Kích hoạt
                        </option>
                        <option value="inactive" {{ request()->status === 'inactive' ? 'selected' : false }}>Chưa kích hoạt
                        </option>

                    </select>
                </div>
                <div class="col-4"><input name="keywords" type="search" class="form-control"
                        placeholder="từ khóa tìm kiếm" value="{{ request()->keywords }}"></div>

                <div class="col-2">
                    <button class="btn-primary btn btn-block">Tìm kiếm</button>
                </div>
            </div>
        </form>
        <a href="{{ route('users.add') }}" class="btn btn-primary mb-2">Thêm người dùng</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col"><a href="?sort-by=fullname&sort-type={{ $sortType }}">Tên</a></th>
                    <th scope="col"><a href="?sort-by=email&sort-type={{ $sortType }}">Email</a></th>
                    <th scope="col"><a href="?sort-by=create_at&sort-type={{ $sortType }}">Thời gian</a></th>
                    <th scope="col" with="10%">Trạng thái</th>
                    <th scope="col" with="10%">Nhóm</th>

                    <th>Sửa</th>
                    <th>xóa</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($usersList))
                    @foreach ($usersList as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->fullname }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->create_at }}</td>

                            <td>{!! $value->status === 0
                                ? '<button class="btn-danger btn">chưa kích hoạt</button>'
                                : '<button class="btn-success btn"> kích hoạt</button>' !!}
                            </td>
                            <td>{{ $value->group_name }}</td>
                            <td><a href="{{ route('users.edit', ['id' => $value->id]) }}"
                                    class="btn btn-warning btn-sm">Sửa</a>
                            </td>
                            <td><a onclick="return confirm('bạn có chắc chắn xóa user ! ')"
                                    href="{{ route('users.delete', ['id' => $value->id]) }}"
                                    class="btn btn-danger btn-sm">xóa</a>
                            </td>
                        </tr>
                    @endforeach;
                @else
                    <tr>
                        <th scope="row" colspan="6">không có dữ liệu</th>

                    </tr>
                @endif

            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $usersList->links() }}
        </div>

    </section>
@endsection
