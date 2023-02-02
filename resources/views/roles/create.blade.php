@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>
                <div class="card-body">
                   <ul class="list-group">
                       <a href="{{ route('roles.index') }}" class="list-group-item list-group-action">View</a>
                       <a href="{{ route('roles.create') }}" class="list-group-item list-group-action">Create</a>
                   </ul>
                </div>
            </div>
            @if (count($errors)>0)
            <div class="card mt-5">
                <div class="card-body">
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>    
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Roles') }}</div>

                <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="role_id" class="col-md-4 col-form-label text-md-end">{{ __('Role ID') }}</label>

                        <div class="col-md-6">
                            <input id="role_id" type="text" class="form-control @error('role_id') is-invalid @enderror" name="role_id" value="{{ old('role_id') }}" required autocomplete="role_id" autofocus>

                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="role_name" class="col-md-4 col-form-label text-md-end">{{ __('Role Name') }}</label>

                        <div class="col-md-6">
                            <input id="role_name" type="text" class="form-control @error('role_name') is-invalid @enderror" name="role_name" value="{{ old('role_name') }}" required autocomplete="role_name" autofocus>

                            @error('role_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="role_enabled" class="col-md-4 col-form-label text-md-end">{{ __('Role Enabled') }}</label>

                        <div class="col-md-6">
                            <select class="form-control select  @error('role_enabled') is-invalid @enderror" name="role_enabled" id="role_enabled" style="width: 100% !important;">
                                <option value="">::select option::</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('role_enabled')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="requires_login" class="col-md-4 col-form-label text-md-end">{{ __('Requires Login') }}</label>

                        <div class="col-md-6">
                            <select class="form-control select  @error('requires_login') is-invalid @enderror" name="requires_login" id="requires_login" style="width: 100% !important;">
                                <option value="">::select option::</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('requires_login')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<script>
    select();
</script>
@endsection
