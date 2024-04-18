@extends('admin.layouts.main')

@section('title', 'Add Category')

@section('main_content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin_category_store') }}" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Add Category</h5>
                    <div class="form-group mb-3">
                        <label>Category Name</label>
                        <select name="category_name" class="form-control">
                            <option value="" disabled selected hidden>--- Pilih ---</option>
                            <option value="Photo">Photo</option>
                            <option value="Video">Video</option>
                            <option value="Audio">Audio</option>
                            <option value="Awok">Awok</option>
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label text-dark ">Category Name</label>
                        <input type="text" class="form-control" id="category_name" placeholder="Category Name"
                            name="category_name">
                    </div> --}}
                    {{-- <div class="form-group mb-3">
                        <label>Show On Menu?</label>
                        <select name="show_on_menu" class="form-control">
                            <option value="Show">Show</option>
                            <option value="Hide">Hide</option>
                        </select>
                    </div> --}}
                    <div class="my-3">
                        <input type="submit" class="btn btn-primary" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="" style="height: 35.5rem"></div>
@endsection
