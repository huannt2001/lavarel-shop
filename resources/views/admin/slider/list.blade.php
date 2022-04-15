<?php
use App\Helpers\Helpers;
?>
@extends('admin.main')

@section('content')
    <table class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th style="width:40%">Link</th>
                <th>Ảnh</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->url }}</td>
                    <td>
                        <a href="{{ $item->thumb }}" target="_blank">
                            <img src="{{ $item->thumb }}" alt="" width="100px">
                        </a>
                    </td>
                    <td>{!! Helpers::active($item->active) !!}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a href="/admin/sliders/edit/{{ $item->id }}" class="btn btn-primary">
                            <i class=" fas fa-pen"></i>
                        </a>
                        <a href="#" class="btn btn-danger"
                            onclick="removeRow({{ $item->id }}, '/admin/sliders/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $sliders->links() !!}
@endsection
