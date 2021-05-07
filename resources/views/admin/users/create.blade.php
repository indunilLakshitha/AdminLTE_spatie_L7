@extends('admin.app')

@section('content')



<!-- Main content -->
<div class="content">
    <div class="container">
        <!-- Content Wrapper. Contains page content -->
        {{-- <div class="content-wrapper"> --}}
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users<a class="btn btn-app" href="{{route('users.index')}}">
                                <i class="fas fa-backward"></i> Back
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
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create User </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li class="swalDefaultSuccess">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif


                            <form role="form" action="{{route('users.store')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter email">
                                    </div>
                                    {{-- <div class="form-group">
                                  <label for="exampleInputPassword1">Password</label>
                                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Roles</label>
                                    @foreach ($roles as $role )

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="" name="roles[]"
                                            value="{{$role->id}}">
                                        <label class="form-check-label" for="exampleCheck1">{{$role->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @can('users.direct.Permissions')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Direct Permissions</label>
                                    @foreach ($permissions as $permission )
                                    <div class="form-check ml-3">
                                      <input type="checkbox" class="form-check-input" id="permission" name="permissions[]" value="{{$permission->id}}">
                                      <label class="form-check-label" for="exampleCheck1">{{$permission->display_name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                                </div>
                                @endcan
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                {{-- <button type="button" class="btn btn-primary" onclick="alerts()">Submit</button> --}}
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
</div>



{{-- </div> --}}
<!-- /.content-wrapper -->


@endsection
