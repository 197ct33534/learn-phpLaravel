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
        <h1 class="h3 mb-0 text-gray-800">Danh sách bài viết</h1>

    </div>
    <p><a href="{{ route('admin.posts.add') }}"><button class="btn btn-primary">Thêm bài viết</button></a></p>

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Người đăng</th>

                <th scope="col">Sửa</th>
                <th scope="col">Xóa</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($postList as $idx => $post)
                <tr>
                    <th scope="row">{{ $idx + 1 }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->getUser->name }}</td>

                    <td>
                        <a href="{{ route('admin.posts.edit', $post) }}"><button class="btn btn-warning">Sửa</button></a>
                    </td>
                    <td>

                        <a href="{{ route('admin.posts.delete', $post) }}"
                            onclick="return confirm('bạn có chắc chắn xóa ?')"><button
                                class="btn btn-danger">Xóa</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection('content')
