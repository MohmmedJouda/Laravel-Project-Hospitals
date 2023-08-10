@extends('admin/layout')
@section('title', 'New Doctor')
@section('content')

    <div class="col-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Quick Example</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('doctors.store') }}" enctype="multipart/form-data">
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
                    <div class="form-group" data-select2-id="28">
                        <label>Select Hospitals</label>
                        <select class="select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="16"
                            tabindex="-1" aria-hidden="true" name="hospital_id">
                            @foreach ($hospital as $hos)
                                <option value="{{ $hos->id }}">{{ $hos->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Email</label>
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                            placeholder="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1"
                            placeholder="phone" value="{{ old('phone') }}">
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
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Descrption</label>
                        <input type="text" name="descrption" class="form-control" id="exampleInputEmail1"
                            placeholder="descrption" value="{{ old('descrption') }}">
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


@section('script')
    <script>
        //Initialize Select2 Elements
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection


{{-- <div class="form-group" data-select2-id="88">

    <select class="form-control select2 select2-danger select2-hidden-accessible"
        data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="11"
        tabindex="-1" aria-hidden="true">
        @foreach ($hospital as $hos)
            <option  value="{{ $hos->id }}">{{ $hos->name }}</option>
        @endforeach
    </select>
</div> --}}
