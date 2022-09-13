@extends('layouts.admin')

@section('title', 'Thêm bài viết')
@section('content')
    @if ($errors->any())
        <div class="text-center alert alert-danger"> Vui lòng kiểm tra dữ liệu nhập vào</div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm bài viết</h1>
    </div>
    <form action="{{ route('admin.posts.postAdd') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input name="title" placeholder="tiêu đề ..." type="text" class="form-control" id="title"
                value="{{ old('title') }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror (session('name'))

        </div>
        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" placeholde="nội dung ...." class="form-control" id="content" rows="10">{{ old('content') }}</textarea>

            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror (session('name'))
        </div>

        <button type="submit" class="btn btn-primary">Thêm bài viết</button>
    </form>
@endsection('content')
