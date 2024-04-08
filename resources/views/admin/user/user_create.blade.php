@extends('admin.layouts.main')

@section('title', 'Add User')

@section('main_content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin_user_store') }}" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Add User</h5>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">NIM</label>
                        <input type="number" class="form-control" id="nim" placeholder="Nim" name="nim">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Skill</label>
                        <input type="text" class="form-control" id="skill" placeholder="Skill" name="skill">
                    </div>
                    <label for="gender" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <div class="form-group mb-3 mx-5">
                        <div class="form-group">
                            <div class="form-check-info">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" id="male"
                                        value="Pria"> Pria
                                </label>
                            </div>
                            <div class="form-check-info">
                                <!-- Sesuaikan nilai margin sesuai kebutuhan -->
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" id="female"
                                        value="Wanita"> Wanita
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                    <div class="my-3">
                        <input type="submit" class="btn btn-primary" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="" style="height: 35.5rem"></div>
@endsection
