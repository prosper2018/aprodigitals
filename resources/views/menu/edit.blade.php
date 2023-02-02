@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
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
            <div class="card">
                <div class="card-header">{{ __('Edit Role') }}</div>

                <form action="{{ route('roles.update', $role->role_id) }}" method="post" enctype="multipart/form-data">  @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="role_id" class="col-md-4 col-form-label text-md-end">{{ __('Role ID') }}</label>

                        <div class="col-md-6">
                            <input id="role_id" type="text" class="form-control @error('role_id') is-invalid @enderror" name="role_id" value="{{ $role->role_id }}" required autocomplete="role_id" autofocus disabled>

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
                            <input id="role_name" type="text" class="form-control @error('role_name') is-invalid @enderror" name="role_name" value="{{ $role->role_name  }}" required autocomplete="role_name" autofocus>

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
                                <option value="1" {{ ($role->role_enabled == 1) ? "selected" : ""  }}>Yes</option>
                                <option value="0" {{ ($role->role_enabled == 0) ? "selected" : ""  }}>No</option>
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
                                <option value="1" {{ ($role->requires_login == 1) ? "selected" : ""  }}>Yes</option>
                                <option value="0" {{ ($role->requires_login == 0) ? "selected" : ""  }}>No</option>
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
