<?php
use App\Helpers\Helpers;
?>
@extends('admin.main')

@section('content')
    <table class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {!! Helpers::menu($menus) !!}
        </tbody>
    </table>
@endsection
