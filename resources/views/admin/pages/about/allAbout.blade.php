@extends('admin.layouts.admin_master')

@section('contents')
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card card-default bg-body-secondary">
                <div class="card-header card-header-border-bottom p-3 bg-body-secondary justify-content-between">
                    <h2>All About</h2>
                    <a href="{{ route('admin.addAbout') }}" type="button" class="btn btn-primary">Add About</a>
                </div>

                <div class="card-body p-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">通番</th>
                                <th scope="col">Title</th>
                                <th scope="col">Short Description</th>
                                <th scope="col">Long Description</th>
                                <th scope="col" width=180>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($abouts as $key => $about)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $about->title }}</td>
                                    <td>{!! nl2br($about->short_dis) !!}</td>
                                    <td>{!! nl2br($about->long_dis) !!}</td>

                                    <td>
                                        <a href="{{ route('edit.about', ['id' => $about->id]) }}"
                                            class="btn btn-primary">編集</a>
                                        <a href="{{ route('delete.about', ['id' => $about->id]) }}"
                                            class="btn btn-danger delete">削除</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">私について情報がありません。</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
