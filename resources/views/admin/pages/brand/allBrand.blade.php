@extends('admin.layouts.admin_master')

@section('contents')
    <div class="row">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card card-default bg-body-secondary">
                <div class="card-header card-header-border-bottom p-3 bg-body-secondary">
                    <h2>All Brand</h2>
                </div>
                <div class="card-body p-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">通番</th>
                                <th scope="col">ブランド名</th>
                                <th scope="col">ブランド画像</th>
                                <th scope="col">アップロード日付</th>
                                <th scope="col">アクション</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $key => $brand)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td><img src="{{ asset($brand->brand_url) }}" alt="{{ $brand->brand_url }}" width=100>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($brand->create_at)->diffForHumans() }}
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.brand', ['id' => $brand->id]) }}"
                                            class="btn btn-primary">編集</a>
                                        <a href="{{ route('delete.brand', ['id' => $brand->id]) }}"
                                            class="btn btn-danger">削除</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td scope="row">1</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom p-3 bg-body-secondary">
                    <h2>Add Brand</h2>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('update.brand') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Brand Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="exampleFormControlInput1">
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

                        <div class="form-footer pt-3 mt-4 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
