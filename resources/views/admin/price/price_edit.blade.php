@extends('admin.layouts.main')

@section('title', 'Edit Price')

@section('main_content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin_price_update', $edit->name) }}" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Update Price</h5>
                    <div class="form-group mb-3">
                        <label>Price Name</label>
                        <select name="priceName" class="form-control">
                            <option value="" disabled selected hidden>--- Pilih ---</option>
                            <option value="1 Bulan" @if ($edit->name == '1 Bulan') selected @endif>1 Bulan</option>
                            <option value="6 Bulan" @if ($edit->name == '6 Bulan') selected @endif>6 Bulan</option>
                            <option value="1 Tahun" @if ($edit->name == '1 Tahun') selected @endif>1 Tahun</option>
                            <option value="2 Tahun" @if ($edit->name == '2 Tahun') selected @endif>2 Tahun</option>
                            <option value="3 Menit" @if ($edit->name == '3 Menit') selected @endif>3 Menit</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Harga</label>
                        <input type="number" class="form-control" id="category_name" placeholder="Price" name="price"
                            value="{{ $edit->price }}">
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
