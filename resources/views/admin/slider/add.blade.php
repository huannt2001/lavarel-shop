@extends('admin.main')

@section('head')
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
    <form action="" method='POST' enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu đề</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id=""
                            placeholder="Nhập tiêu đề">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Đường dẫn</label>
                        <input type="text" name="url" value="{{ old('url') }}" class="form-control" id=""
                            placeholder="Nhập đường dẫn">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="menu">Sắp xếp</label>
                        <input type="number" name="sort_by" value="1" class="form-control" id="" placeholder="">
                    </div>
                </div>
                <div class="col-md-12">
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

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tải ảnh</label>
                        <input type="file" class="form-control" id="upload">
                        <div id="image_show" class="mt-3">

                        </div>
                        <input type="hidden" name='thumb' id="file">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo Slider</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content')
    </script>
@endsection
