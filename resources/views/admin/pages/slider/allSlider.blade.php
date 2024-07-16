@extends('admin.layouts.admin_master')

@section('contents')
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card card-default bg-body-secondary">
                <div class="card-header card-header-border-bottom p-3 bg-body-secondary justify-content-between">
                    <h2>All Slider</h2>
                    <a href="{{ route('admin.addSlider') }}" type="button" class="btn btn-primary">Add Slider</a>
                </div>

                <div class="card-body p-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">通番</th>
                                <th scope="col">Slider Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col" width=180>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $key => $slider)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{!! nl2br($slider->description) !!}</td>
                                    <td><img src="{{ asset($slider->image) }}" alt="{{ $slider->image }}" width=100>
                                    </td>

                                    <td>
                                        <a href="{{ route('edit.slider', ['id' => $slider->id]) }}"
                                            class="btn btn-primary">編集</a>
                                        <a href="{{ route('delete.slider', ['id' => $slider->id]) }}"
                                            class="btn btn-danger">削除</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">スライダー情報がありません。</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
