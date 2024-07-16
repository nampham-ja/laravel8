@extends('admin.layouts.admin_master')

@section('contents')
    <div class="row">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card card-default">
                <div class="card-header card-header-border-bottom p-3 bg-body-secondary">
                    <h2>Add About</h2>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('update.about') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value={{ $about->id ?? '' }}>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">About Title</label>
                            <input type="text" name="title" value="{{ $about->title ?? '' }}"
                                class="form-control @error('title') is-invalid @enderror" id="exampleFormControlInput1">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Short Description</label>
                            <textarea class="form-control @error('short_dis') is-invalid @enderror" name="short_dis"
                                id="exampleFormControlTextarea1" rows="3">{!! $about->short_dis ?? '' !!}</textarea>
                            @error('short_dis')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Long Description</label>
                            <textarea class="form-control @error('long_dis') is-invalid @enderror" name="long_dis" id="exampleFormControlTextarea1"
                                rows="3">{!! $about->long_dis ?? '' !!}</textarea>
                            @error('long_dis')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        @if (isset($about->image) && !empty($about->image))
                            <img src="{{ asset($about->image) }}" alt="{{ $about->title }}" width=200>
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
