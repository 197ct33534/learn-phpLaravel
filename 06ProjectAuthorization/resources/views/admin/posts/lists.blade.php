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
    @can('create', App\Models\Posts::class)
        <p><a href="{{ route('admin.posts.add') }}"><button class="btn btn-primary">Thêm bài viết</button></a></p>
    @endcan

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Người đăng</th>
                @can('posts.edit')
                    <th scope="col">Sửa</th>
                @endcan
                @can('posts.delete')
                    <th scope="col">Xóa</th>
                @endcan
            </tr>
        </thead>
        <tbody>

            @foreach ($postList as $idx => $post)
                <tr>
                    <th scope="row">{{ $idx + 1 }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->getUser->name }}</td>
                    @can('posts.edit')
                        <td>
                            <a href="{{ route('admin.posts.edit', $post) }}"><button class="btn btn-warning">Sửa</button></a>
                        </td>
                    @endcan
                    @can('posts.delete')
                        <td>

                            <a href="{{ route('admin.posts.delete', $post) }}"
                                onclick="return confirm('bạn có chắc chắn xóa ?')"><button
                                    class="btn btn-danger">Xóa</button></a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection('content')
