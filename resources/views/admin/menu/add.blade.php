@extends('admin.main')

@section('head')
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
    <form action="" method='POST'>
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên Danh Mục</label>
                <input type="text" name="name" class="form-control" id="" placeholder="Nhập tên danh mục">
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Danh muc</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Danh mục cha</option>
                    @if (!empty($menus))
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea type="text" name="description" class="form-control" id=""></textarea>
            </div>
            <div class="form-group">
                <label for="">Mô tả chi tiết</label>
                <textarea type="text" name="content" class="form-control" id="content"></textarea>
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" name="active">
                    <label class="form-check-label">Có</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="0" name="active">
                    <label class="form-check-label">Không</label>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo danh mục</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content')
    </script>
@endsection
