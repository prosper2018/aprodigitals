@extends('layouts.layout')
@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs breadcrumbs-label">
    <div class="container">

        <ol>
            <li><a href="/" class="breadcrumbs-link">Home</a></li>
            <li>Menu</li>
        </ol>
        <h2 style="color: white;">Menu</h2>

    </div>
</section><!-- End Breadcrumbs -->
<div class="container" style="padding-top: 40px !important;">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>
                <div class="card-body">
                    <ul class="list-group">
                        <a href="{{ route('menu.index') }}" class="list-group-item list-group-action">View</a>
                        <a href="{{ route('menu.create') }}" class="list-group-item list-group-action">Create</a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('All Menu') }}</div>
                <a href="{{ route('menu.create') }}"><button class="btn btn-success" style="float: right">Add Menu</button></a>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Menu ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">URL</th>
                                <th scope="col">Parent ID</th>
                                <th scope="col">Status</th>
                                <th scope="col">Posted User</th>
                                <th scope="col">Posted IP</th>
                                <th scope="col">Created</th>
                                <th scope="col">Last Modified</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($menus)>0)

                            @foreach ($menus as $key => $menu)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $menu->menu_id }}</td>
                                <td>{{ $menu->menu_name }}</td>
                                <td>{{ $menu->menu_url }}</td>
                                <td>{{ $menu->parent_id }}</td>
                                <td>{{ $menu->status }}</td>
                                <td>{{ $menu->posted_user }}</td>
                                <td>{{ $menu->posted_ip }}</td>
                                <td>{{ $menu->created_at }}</td>
                                <td>{{ $menu->updated_at }}</td>
                                <td><a href="{{ route('roles.edit', $menu->menu_id ) }}"><button class="btn btn-primary">Edit</button></a></td>
                                <td><button type="button" class="btn btn-danger" onclick="show_modal('{{ $menu->menu_id }}')" data-toggle="modal" data-target="#exampleModal{{ $menu->menu_id }}">
                                        Delete
                                    </button></td>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $menu->menu_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <form action="{{ route('roles.destroy', $menu->menu_id) }}" method="POST"> @csrf
                                        @method('DELETE')
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete confirmation</h5>
                                                    <button type="button" class="close modal_close" onclick="close_modal('{{ $menu->menu_id }}')" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary modal_close" data-dismiss="modal" onclick="close_modal('{{ $menu->menu_id }}')">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </tr>
                            @endforeach
                            @else
                            <p>No role to show</p>
                            @endif
                        </tbody>
                    </table>
                    {{ $menus->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection