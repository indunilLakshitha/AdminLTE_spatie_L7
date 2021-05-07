@extends('admin.app')

@section('content')



<!-- Main content -->
<div class="content">
    {{-- <div class="container"> --}}
    <!-- Content Wrapper. Contains page content -->
    {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users<a class="btn btn-app" href="{{route('users.create')}}">
                            <i class="fas fa-plus"></i> Add
                        </a></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Users</a> </li>
                        <li class="breadcrumb-item active">All</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Responsive Hover Table</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 350px;">
                                    {{-- <form action="{{route('users.serch')}}" role="search" method="POST"> --}}
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="table_search" class="form-control float-right"
                                                    placeholder="Search" style="width: 200px;">
                                            </div>
                                            <div class="col">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap ">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">ID</th>
                                        <th style="text-align:center">User</th>
                                        <th style="text-align:center">Email</th>
                                        <th style="text-align:center">Role</th>
                                        <th style="text-align:center">Status</th>
                                        <th style="text-align:center">Created</th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($users)
                                    @foreach ($users as $user)
                                    <tr>
                                        <td style="text-align:center">{{$user->id}}</td>
                                        <td style="text-align:center">{{$user->name}}</td>
                                        <td style="text-align:center">{{$user->email}}</td>
                                        <td style="text-align:center">
                                            @foreach ($user->roles as $role )

                                            <span class=" badge bg-primary"> {{$role->name}}</span>

                                            @endforeach
                                        </td>
                                        <td style="text-align:center">
                                            @if ($user->is_blocked==1)
                                            <span class=" badge bg-danger">BLOCKED</span>
                                            @else
                                            <span class=" badge bg-primary">ACTIVE</span>
                                            @endif
                                        </td>
                                        <td style="text-align:center">{{$user->created_at}}</td>
                                        <td style="text-align:center">
                                            <div class="btn-group">
                                                @can('users.block')

                                                @if ($user->is_blocked==1)
                                                <button type="button" onclick="block({{$user->id}},'users/block')"
                                                    class="btn btn-primary">UNBLOCK</button>
                                                @else
                                                <button type="button" onclick="block({{$user->id}},'users/block')"
                                                    class="btn btn-danger">BLOCK</button>

                                                @endif
                                                @endcan
                                                @can('users.edit')

                                                <button type="button" class="btn btn-default"
                                                    onclick="window.location.href='/users/edit/{{$user->id}}'">
                                                    EDIT</button>
                                                @endcan
                                                <button type="button" class="btn btn-default">Right</button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endisset

                                </tbody>
                            </table>

                            <div class="ml-5 mt-2">
                                {{ $users->links() }}

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    {{-- </div> --}}
    <!-- /.row -->
</div><!-- /.container-fluid -->
</div>



{{-- </div> --}}
<!-- /.content-wrapper -->


@endsection
