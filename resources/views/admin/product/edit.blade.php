@extends('admin.main')

@section('head')
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
    <form action="" method='POST' enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên Sản Phẩm</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" id=""
                    placeholder="Nhập tên sản phẩm">
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Danh mục</label>
                <select class="form-control" name="menu_id">
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" {{ $product->menu_id == $menu->id ? 'selected' : '' }}>
                            {{ $menu->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Giá Gốc</label>
                <input type="number" name="price" value="{{ $product->price }}" class="form-control" id=""
                    placeholder="Nhập giá gốc sản phẩm">
            </div>
            <div class="form-group">
                <label for="">Giá Giảm</label>
                <input type="number" name="price_sale" value="{{ $product->price_sale }}" class="form-control" id=""
                    placeholder="Nhập giá giảm sản phẩm">
            </div>
            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea type="text" name="description" class="form-control" id="">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="">Mô tả chi tiết</label>
                <textarea type="text" name="content" class="form-control" id="content">{{ $product->content }}</textarea>
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" name="active"
                        {{ $product->active == 1 ? 'checked' : '' }} />
                    <label class="form-check-label">Có</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="0" name="active"
                        {{ $product->active == 0 ? 'checked' : '' }} />
                    <label class="form-check-label">Không</label>
                </div>
            </div>

            <div class="form-group">
                <label>Tải ảnh</label>
                <input type="file" class="form-control" id="upload">
                <div id="image_show" class="mt-3">
                    <a href="{{ $product->thumb }}" target="_blank">
                        <img src="{{ $product->thumb }}" alt="" width="100px">
                    </a>
                </div>
                <input type="hidden" name='thumb' value="{{ $product->thumb }}" id="file">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content')
    </script>
@endsection
