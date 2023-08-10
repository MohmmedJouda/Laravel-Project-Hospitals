@extends('admin/layout')
@section('title', 'Home')
@section('content')


    <!-- Main content -->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Hospitals</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>
                        <p class="card-text">With supporting text below as a natural lead-in to additional
                            content.</p>
                        Total number: <h4>{{ $hospitals_number }}</h4>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Majors</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>
                        <p class="card-text">With supporting text below as a natural lead-in to additional
                            content.</p>
                        Total number: <h4>{{ $majors_number }}</h4>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Doctors</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>

                        <p class="card-text">With supporting text below as a natural lead-in to additional
                            content.</p>
                        Total number:<h4>{{ $doctors_number }}</h4>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Admins</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>
                        <p class="card-text">With supporting text below as a natural lead-in to additional
                            content.</p>
                        Total number: <h4>{{ $admins_number - 1 }}</h4>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content -->
@endsection
