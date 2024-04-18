@extends('admin.layouts.main')

@section('title', 'Edit Category')

@section('main_content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin_category_update', $edit->name) }}" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Update Category</h5>
                    <div class="form-group mb-3">
                        <label>Category Name</label>
                        <select name="category_name" class="form-control">
                            <option value="" disabled selected hidden>--- Pilih ---</option>
                            <option value="Photo" @if ($edit->name == 'Photo') selected @endif>Photo</option>
                            <option value="Video" @if ($edit->name == 'Video') selected @endif>Video</option>
                            <option value="Audio" @if ($edit->name == 'Audio') selected @endif>Audio</option>
                            <option value="Awok" @if ($edit->name == 'Awok') selected @endif>Awok</option>
                        </select>
                    </div>
                    {{-- <div class="form-group mb-3">
                        <label>Show On Menu?</label>
                        <select name="show_on_menu" class="form-control">
                            <option value="Show" @if ($edit->show_on_menu == 'Show') selected @endif>Show</option>
                            <option value="Hide" @if ($edit->show_on_menu == 'Hide') selected @endif>Hide</option>
                        </select>
                    </div> --}}
                    <div class="my-3">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="" style="height: 35.5rem"></div>
@endsection
