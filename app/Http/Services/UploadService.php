<?php

namespace App\Http\Services;

class UploadService
{
    public function store($request)
    {

        // Kiem tra xem file co ton tai khong
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();

                $pathFull = 'uploads/' . date('Y/m/d');
                $path = $request->file('file')->storeAs(
                    'public/' . $pathFull,
                    // $pathFull,
                    $name
                );
                return asset('/' . $path);
                // return $path;
            } catch (\Exception $err) {
                return  $err;
            }
        } else {
            return 'Upload file error';
        }
    }
}
