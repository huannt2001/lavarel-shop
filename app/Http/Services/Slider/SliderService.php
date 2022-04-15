<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function insert($request)
    {
        try {
            $request->except('_token');
            Slider::create($request->all());
            Session::flash('success', 'Thêm Slider thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm Slider thất bại ');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function getAllSliders()
    {
        return Slider::orderByDesc('id')->paginate(15);
    }

    public function update($request, $slider)
    {
        try {
            $slider->fill($request->input());
            $slider->save();
            Session::flash('success', 'Cập nhật Slider thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật Slider thất bại');
            Log::info($err->getMessage());
            return false;
        }
    }

    public function delete($request)
    {
        $id = $request->input('id');
        $slider = Slider::where('id', $id)->first();
        $path = $slider->thumb;
        $path = strstr($path, 'storage');
        $path = str_replace('storage', 'public', $path);
        if ($slider) {
            Storage::delete($path);
            $slider->delete();
            return true;
        } else {
            return false;
        }
    }

    public function show()
    {
        return Slider::where('active', 1)->orderByDesc('sort_by')->get();
    }
}
