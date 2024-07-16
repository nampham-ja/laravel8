@extends('admin.layouts.admin_master')

@section('contents')
    <div class="row">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card card-default">
                <div class="card-header card-header-border-bottom p-3 bg-body-secondary">
                    <h2>Add Slider</h2>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('update.slider') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value={{ $slider->id ?? '' }}>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Slider Name</label>
                            <input type="text" name="title" value="{{ $slider->title ?? '' }}"
                                class="form-control @error('title') is-invalid @enderror" id="exampleFormControlInput1">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                id="exampleFormControlTextarea1" rows="3">{!! $slider->description ?? '' !!}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="exampleFormControlFile1">Image</label>
                            <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror"
                                id="exampleFormControlFile1">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        @if (isset($slider->image) && !empty($slider->image))
                            <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}" width=200>
                        @endif

                        <div class="form-footer pt-3 mt-4 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">

        </div>
    </div>
@endsection
