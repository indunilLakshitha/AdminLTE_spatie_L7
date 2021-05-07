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
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit User </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('users.update',$users->id)}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" value="{{$users->name}}"
                                            name="name" placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Roles</label>

                                        @foreach ($roles as $role )

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="" name="roles[]"
                                                value="{{$role->id}}" @foreach($users->roles as $my_perm)
                                            @if($role->id ==$my_perm->id)
                                            checked
                                            @endif
                                            @endforeach>
                                            <label class="form-check-label " for="exampleCheck1">{{$role->name}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @can('users.direct.Permissions')
                                    <div class="form-group">
                                        <label for="name">Direct Permissions</label>
                                        <div class="row">

                                            @foreach ($all_permissions as $permission )

                                            <div class="form-check">

                                                <div class="col-3">
                                                    <div class="row">

                                                        <div class="col-3">

                                                            <input type="checkbox" class="form-check-input" id=""
                                                                name="permissions[]" value="{{$permission->id}}"
                                                                @foreach($my_permissions->permissions as $my_perm)
                                                            @if($permission->id ==$my_perm->id)
                                                            checked
                                                            @endif
                                                            @endforeach>
                                                        </div>
                                                        <div class="col-9">
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">{{$permission->display_name}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endcan
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
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
