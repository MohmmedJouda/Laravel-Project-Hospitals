@extends('admin.layout')
@section('title', 'Majors')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">Majors Table</h3>

                <a href="{{ route('majors.create') }}" class="btn btn-success float-right">Add Major</a>

            </div>
            <!-- /.card-header -->
            <div class="card-body">

                {{-- اذا كان السيشن يحتوي على رسالة يقوم بعرض الرسالة الموجودة بداخله  --}}
                @if (session()->has('msg'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success</h5>
                        <h4> {{ session()->get('msg') }}</h3>
                    </div>
                @endif


                @if (session()->has('del'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        <h4> {{ session()->get('del') }}</h3>
                    </div>
                @endif

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">id</th>
                                <th>Name</th>
                                <th>Cover</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $major)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $major->name }}</td>
                                    <td><img src="{{ Storage::url('majors/' . $major->cover) }}" alt="Not Found"
                                            width="60" height="60"></td>

                                    <td> <span
                                            class="bridge {{ $major->is_active ? 'bg-success aaa' : 'bg-danger' }}">{{ $major->is_active }}
                                        </span></td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('majors.edit', $major->id) }}" class="btn btn-info">
                                                <i class="fas fa-edit"></i></a>


                                            <button style="margin-left: 10px" type="button"
                                                class="btn btn-block bg-gradient-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="fab fa-elementor"></i>
                                            </button>



                                            <form method="POST" action="{{ route('majors.destroy', $major->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="margin-left: 10px">
                                                    <i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
