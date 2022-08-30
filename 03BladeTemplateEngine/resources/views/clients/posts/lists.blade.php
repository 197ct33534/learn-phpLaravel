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
        <form method="post" action="{{ route('posts.delete-any') }}"
            onsubmit="return confirm('Are you sure you want to delete this')">
            <button typpe='submit' class='btn btn-danger'>xóa (
                0)</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id='checkall'></th>
                        <th scope="col">STT</th>
                        <th>Tiêu đề</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>


                    </tr>
                </thead>
                <tbody>
                    @if ($allposts->count() > 0)
                        @foreach ($allposts as $key => $item)
                            <tr>
                                <td> <input type="checkbox" name="delete[]" value="{{ $item->id }}"></td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td width="15%">
                                    @if ($item->trashed())
                                        <button class="btn btn-danger">Đã xóa</button>
                                    @else
                                        <button class="btn btn-success">Chưa xóa</button>
                                    @endif
                                </td>
                                <td width="15%">
                                    @if ($item->trashed())
                                        <a onclick="return confirm('are you sure?')"
                                            href="{{ route('posts.restore', $item) }}" class="btn btn-info">Khôi
                                            phục</a>
                                        <a onclick="return confirm('are you sure?')"
                                            href="{{ route('posts.force-delete', $item) }}" class="btn btn-danger">Xóa vĩnh
                                            viễn</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif


                </tbody>
            </table>
            @csrf
        </form>
    </section>
@endsection
