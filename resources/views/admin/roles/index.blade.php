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
                        <h1>Roles<a class="btn btn-app" href="{{route('roles.create')}}">
                                <i class="fas fa-plus"></i> Add
                            </a></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Rolse</a> </li>
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
                                <h3 class="card-title">Roles List</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Role</th>
                                            <th>Guard Name</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role )
                                        <tr>
                                            <td>{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->guard_name}}</td>
                                            <td>{{$role->created_at}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    @can('roles.edit')
                                                    <button type="button" onclick="window.location.href='/roles/edit/{{$role->id}}'" class="btn btn-info">Edit</button>
                                                    @endcan
                                                    @can('roles.delete')
                                                    <button type="button" class="btn btn-danger" onclick="remove({{$role->id}},'roles/delete')">Delete</button>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
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
