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
                        <h1>Roles<a class="btn btn-app" href="{{route('roles.index')}}">
                                <i class="fas fa-backward"></i> Back
                            </a></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Roles</a> </li>
                            <li class="breadcrumb-item active">Add</li>
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
                                <h3 class="card-title">Edit Role </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('roles.update',$my_permissions->id)}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{$my_permissions->name}}" placeholder="Enter Role Name">
                                            @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li class="swalDefaultSuccess">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                @foreach ($all_permissions as $permission )

                                <div class="form-check ml-3">
                                    <input type="checkbox" class="form-check-input" id="permission" name="permission[]"
                                        value="{{$permission->id}}"
                                        @foreach($my_permissions->permissions as $my_perm)
                                                 @if($permission->id ==$my_perm->id)
                                                checked
                                                 @endif
                                        @endforeach >
                                    <label class="form-check-label"
                                        for="exampleCheck1">{{$permission->display_name}}</label>
                                </div>
                                @endforeach

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
