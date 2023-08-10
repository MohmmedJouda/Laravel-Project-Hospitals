@extends('admin/layout')
@section('title', 'New Standard')
@section('content')

    <div class="col-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('standards.store') }}" enctype="multipart/form-data">
                @csrf
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
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Standard</label>
                        <input type="text" name="chose_standard" class="form-control" id="exampleInputEmail1"
                            placeholder="chose standard" value="{{ old('chose_standard') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Title</label>
                        <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                            placeholder="title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter New Price</label>
                        <input type="text" name="details" class="form-control" id="exampleInputEmail1"
                            placeholder="details" value="{{ old('details') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Upload image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="cover" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>



@endsection
