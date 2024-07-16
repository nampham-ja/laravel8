@extends('admin.layouts.admin_master')

@section('contents')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                @forelse ($multiImages as $key => $multiImage)
                    <div class="col-md-4"><img src="{{ asset($multiImage->image) }}" alt="{{ $multiImage->image }}"
                            style="width: 100%"></div>
                @empty
                    <div class="col-md-12">画像情報がありません。</div>
                @endforelse
            </div>
        </div>
        <div class="col-md-4">
            <form action="{{ route('update.multi_image') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom p-3">Multi Image</div>
                    <div class="card-body p-3">
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="multi_image" name="multi_image[]"
                                multiple="multiple">
                        </div>
                        <button class="btn btn-primary" type="submit">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
