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
        <a href="{{ route('users.add') }}" class="btn btn-primary mb-2">Thêm người dùng</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">FULLNAME</th>
                    <th scope="col">Email</th>
                    <th scope="col">Thời gian</th>
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
                            <td><a href="{{ route('users.edit', ['id' => $value->id]) }}"
                                    class="btn btn-warning btn-sm">Sửa</a>
                            </td>
                            <td><a onclick="return confirm('bạn có chắc chắn xóa user ! ')"
                                    href="{{ route('users.delete', ['id' => $value->id]) }}"
                                    class="btn btn-danger btn-sm">xóa</a></td>
                        </tr>
                    @endforeach;
                @else
                    <tr>
                        <th scope="row" colspan="6">không có dữ liệu</th>

                    </tr>
                @endif



            </tbody>
        </table>
    </section>
@endsection
