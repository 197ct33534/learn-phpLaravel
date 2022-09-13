@extends('layouts.admin')

@section('title', 'Thêm nhóm người dùng')
@section('content')
    @if ($errors->any())
        <div class="text-center alert alert-danger"> Vui lòng kiểm tra dữ liệu nhập vào</div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm nhóm người dùng</h1>
    </div>
    <form action="{{ route('admin.groups.postAdd') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nameGroup">Họ và tên</label>
            <input name="name" type="text" class="form-control" id="nameGroup" value="{{ old('name') }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror (session('name'))

        </div>

        <button type="submit" class="btn btn-primary">Thêm </button>
    </form>
@endsection('content')
