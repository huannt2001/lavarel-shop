<?php
use App\Helpers\Helpers;
?>
@extends('admin.main')

@section('content')
    <table class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Ngày đặt hàng</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->phonenumber }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <a href="/admin/customers/view/{{ $item->id }}" class="btn btn-primary">
                            <i class=" fas fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-danger"
                            onclick="removeRow({{ $item->id }}, '/admin/customers/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $customers->links() !!}
    </div>
@endsection
