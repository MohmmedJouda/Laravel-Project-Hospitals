@extends('admin/layout')
@section('title', 'New Admin')
@section('content')

    <div class="col-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('admins.update', $admin->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    {{-- <div class="form-group" data-select2-id="28">
                        <label>Select Role</label>
                        <select class="select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="16"
                            tabindex="-1" aria-hidden="true" name="role_id">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="name"
                            value="{{ $admin->name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Email</label>
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                            placeholder="email" value="{{ $admin->email }}">
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleInputEmail1">Enter Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                            placeholder="password">
                    </div> --}}
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>



@endsection

@section('script')
    <script>
        //Initialize Select2 Elements
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
