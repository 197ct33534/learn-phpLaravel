@extends('layouts.admin')

@section('title', 'Phân quyền nhóm ' . $group->name)



@section('content')
    @if (session('msg'))
        <div class="text-center alert alert-success">{{ session('msg') }}</div>
    @endif
    @if (session('error'))
        <div class="text-center alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Phân quyền nhóm {{ $group->name }}</h1>

    </div>
    <form action="" method="post">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Module</th>
                    <th scope="col">Quền</th>


                </tr>
            </thead>
            <tbody>
                @if ($moduleList->count() > 0)
                    @foreach ($moduleList as $module)
                        <tr>

                            <td width="20%">{{ $module->title }}</td>
                            <td>
                                <div class="row">
                                    @if (!empty($roleListArr))
                                        @foreach ($roleListArr as $roleName => $roleValue)
                                            <div class="col-2">
                                                <label for="role_{{ $module->name }}_{{ $roleName }}" class="col-2">

                                                </label>
                                                <input type="checkbox" name="role[{{ $module->name }}][]"
                                                    id="role_{{ $module->name }}_{{ $roleName }}"
                                                    value="{{ $roleName }}">
                                                {{ $roleValue }}
                                            </div>
                                        @endforeach
                                    @endif

                                    @if ($module->name == 'groups')
                                        <div class="col-3">
                                            <label for="role_{{ $module->name }}_permission" class="col-2">

                                            </label>
                                            <input type="checkbox" name="role[{{ $module->name }}][]"
                                                id="role_{{ $module->name }}_permission" value="permission">
                                            Phân quyền
                                        </div>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        <button class="btn btn-primary" type="submit">Phân quyền</button>
        @csrf
    </form>
@endsection('content')
