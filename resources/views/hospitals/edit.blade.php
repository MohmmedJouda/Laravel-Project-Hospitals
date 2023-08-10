@extends('admin/layout')
@section('title', 'Update Hospital')
@section('content')


    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('hospitals.update', $hos->id) }}" enctype="multipart/form-data">
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
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="name"
                            value="{{ $hos->name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Enter Location</label>
                        <input type="text" name="location" class="form-control" id="exampleInputPassword1"
                            placeholder="Location" value="{{ $hos->location }}">
                    </div>

                    <div class="form-group">
                        <label>Descreption</label>
                        <textarea class="form-control" name="info" rows="3" placeholder="Enter your descreption"
                            value="{{ $hos->info }}"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Upload imge</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="cover" class="custom-file-input" id="exampleInputFile"
                                    value="{{ $hos->cover }}">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_active" class="custom-control-input" id="customSwitch1" checked
                                value="{{ $hos->is_active }}">
                            <label class="custom-control-label" for="customSwitch1">Activate</label>
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
{{-- <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Hospital</h3>
    </div>
</div>

<form method="POST" action="{{route('hospital.update',$hos->id)}}">
  @csrf
  @method('put')
    <div class="card-body">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{$hos->name}}">
      </div>
      <div class="form-group">
        <label>Location</label>
        <input type="text" class="form-control" name="location" placeholder="Enter location" value="{{$hos->location}}">
      </div>
      <div class="form-group">
        <label>Info</label>
        <input type="text" class="form-control" name="info" placeholder="Enter info" value="{{$hos->info}}">
      </div>


    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>


  </form> --}}
