@extends('admin.layouts.main')

@section('title', 'Show Dosen')

@section('main_content')
    <div class="container-fluid bg-light">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-lg-8">
                        <div class="my-3">
                            <a href="{{ route('admin_dosen_create') }}" class="btn btn-sm btn-primary"><i
                                    class="fas fa-plus fa-cog"></i> Add Dosen</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-primary text-light">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>NIDN</th>
                                        <th>Status</th>
                                        <th style="min-width: 10rem">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dosens as $item)
                                        @if ($item->role == 'Dosen' || $item->role == 'Dosen Reviewer')
                                            <tr>
                                                <td>{{ $loop->iteration - 1 }}</td>
                                                <td>{{ $item->nama ?? '' }}</td>
                                                <td>{{ $item->email ?? '' }}</td>
                                                <td>{{ $item->nidn ?? '' }}</td>
                                                <td>{{ $item->role ?? '' }}</td>
                                                <td>
                                                    <a href="{{ route('admin_dosen_edit', $item->nama) }}"
                                                        class="btn btn-sm btn-success"><i class="fa fa-edit"></i>
                                                        Edit</a>
                                                    <a href="{{ route('admin_dosen_delete', $item->nama) }}"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('are you sure?')"><i
                                                            class="fa fa-trash-alt"></i>
                                                        Delete</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
