@extends('admin.layouts.admin_master')

@section('contents')
    <div class="row">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card card-default">
                <div class="card-header card-header-border-bottom p-3 bg-body-secondary">
                    <h2>Edit Brand</h2>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('update.brand') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value={{ $brand->id }}>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Brand Name</label>
                            <input type="text" name="name" value="{{ $brand->name ?? '' }}"
                                class="form-control @error('name') is-invalid @enderror" id="exampleFormControlInput1">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Example file input</label>
                            <input type="file" name="brand_image"
                                class="form-control  @error('brand_image') is-invalid @enderror"
                                id="exampleFormControlFile1">
                            @error('brand_image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        @if (isset($brand->brand_url) && !empty($brand->brand_url))
                            <img src="{{ asset($brand->brand_url) }}" alt="{{ $brand->name }}" width=200>
                        @endif

                        <div class="form-footer pt-3 mt-4 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">

        </div>
    </div>
@endsection
