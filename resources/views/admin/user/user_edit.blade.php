@extends('admin.layouts.main')

@section('title', 'Edit User')

@section('main_content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin_user_update', $edit->name) }}" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Update User</h5>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name"
                            value="{{ $edit->name }}" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email"
                            value="{{ $edit->email }}" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">NIM</label>
                        <input type="number" class="form-control" id="nim" placeholder="Nim"
                            value="{{ $edit->nim }}" name="nim">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Skill</label>
                        <input type="text" class="form-control" id="skill" placeholder="Skill"
                            value="{{ $edit->skill }}" name="skill">
                    </div>
                    <label for="gender" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <div class="form-group mb-3 mx-5">
                        <div class="form-group">
                            <div class="form-check-info">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" id="male"
                                        value="Pria" {{ $edit->gender == 'Pria' ? 'checked' : '' }}> Pria
                                </label>
                            </div>
                            <div class="form-check-info">
                                <!-- Sesuaikan nilai margin sesuai kebutuhan -->
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" id="female"
                                        value="Wanita" {{ $edit->gender == 'Wanita' ? 'checked' : '' }}> Wanita
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Status Akun</label>
                        <select name="role" class="form-control">
                            <option value="" disabled selected hidden>--- Pilih ---</option>
                            <option value="premium" @if ($edit->role == 'premium') selected @endif>premium</option>
                            <option value="umum" @if ($edit->role == 'umum') selected @endif>umum</option>
                            <option value="pending" @if ($edit->role == 'pending') selected @endif>pending</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">New Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Retype Password</label>
                        <input type="password" class="form-control" id="password_confirmation" placeholder="Retype Password"
                            name="password_confirmation">
                    </div>
                    <div class="my-3">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="" style="height: 35.5rem"></div>
@endsection
