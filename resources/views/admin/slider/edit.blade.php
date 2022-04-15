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
                        <input type="text" name="name" value="{{ $slider->name }}" class="form-control" id=""
                            placeholder="Nhập tiêu đề">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Đường dẫn</label>
                        <input type="text" name="url" value="{{ $slider->url }}" class="form-control" id=""
                            placeholder="Nhập đường dẫn">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="menu">Sắp xếp</label>
                        {{ $slider->active == 1 ? 'checked' : '' }}
                        <input type="number" name="sort_by" value="{{ $slider->sort_by }}" class="form-control" id=""
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Kích hoạt</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" name="active"
                                {{ $slider->active == 1 ? 'checked' : '' }} />
                            <label class="form-check-label">Có</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name="active"
                                {{ $slider->active == 0 ? 'checked' : '' }} />
                            <label class="form-check-label">Không</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tải ảnh</label>
                        <input type="file" class="form-control" id="upload">
                        <div id="image_show" class="mt-3">
                            <a href="{{ $slider->thumb }}" target="_blank">
                                <img src="{{ $slider->thumb }}" alt="" width="100px">
                            </a>
                        </div>
                        <input type="hidden" name='thumb' value="{{ $slider->thumb }}" id="file">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật Slider</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content')
    </script>
@endsection
