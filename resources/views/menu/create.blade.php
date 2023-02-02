@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>
                <div class="card-body">
                   <ul class="list-group">
                       <a href="{{ route('menu.index') }}" class="list-group-item list-group-action">View</a>
                       <a href="{{ route('menu.create') }}" class="list-group-item list-group-action">Create</a>
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
                <div class="card-header">{{ __('Menu') }}</div>

                <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="menu_id" class="col-md-4 col-form-label text-md-end">{{ __('Menu ID') }}</label>

                        <div class="col-md-6">
                            <input id="menu_id" type="text" class="form-control @error('menu_id') is-invalid @enderror" name="menu_id" value="{{ old('menu_id') }}" required autocomplete="menu_id" autofocus>

                            @error('menu_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="menu_name" class="col-md-4 col-form-label text-md-end">{{ __('Menu Name') }}</label>

                        <div class="col-md-6">
                            <input id="menu_name" type="text" class="form-control @error('menu_name') is-invalid @enderror" name="menu_name" value="{{ old('menu_name') }}" required autocomplete="menu_name" autofocus>

                            @error('menu_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="menu_url" class="col-md-4 col-form-label text-md-end">{{ __('URL (File Name)') }}</label>

                        <div class="col-md-6">
                            <input id="menu_url" type="text" class="form-control @error('menu_url') is-invalid @enderror" name="menu_url" value="{{ old('menu_url') }}" required autocomplete="menu_url" autofocus>

                            @error('menu_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="parent_id" class="col-md-4 col-form-label text-md-end">{{ __('Set Parent Menu') }}</label>

                        <div class="col-md-6">
                            <select class="form-control select  @error('parent_id') is-invalid @enderror" name="parent_id" id="parent_id" style="width: 100% !important;">
                                <option value="">::select option::</option>
                                @foreach ($menus as $key => $menu)
                                    <option value="{{ $menu->menu_id }}">{{ $menu->menu_name }}</option>
                                @endforeach
                                
                            </select>
                            @error('parent_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="icon" class="col-md-4 col-form-label text-md-end">{{ __('Menu Icon') }}</label>

                        <div class="col-md-6">
                            <select class="form-control select  @error('icon') is-invalid @enderror" name="icon" id="icon" style="width: 100% !important;">
                                <option value="">::select option::</option>
                                {{-- <option value="1">Yes</option> --}}
                               
                            </select>
                            @error('icon')
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
