<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuService
{

    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll()
    {
        return Menu::orderByDesc('id')->paginate(20);
    }

    public function show()
    {
        return Menu::select('name', 'id')->where('parent_id', 0)->orderByDesc('id')->get();
    }

    public function create($request)
    {
        try {
            // $data = $request->input();
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (string) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
            ]);

            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request)
    {
        $id = $request->input('id');
        $menu = Menu::where('id', $id)->first();

        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }


        return false;
    }

    public function update($request, $menu): bool
    {
        try {
            // quét toàn bộ thông tin request gửi lên
            // $menu->fill($request->input());
            // $menu->save();

            // cách dễ hiểu
            if ($request->input('parent_id') !== $menu->id) {
                $menu->parent_id = (string) $request->input('parent_id');
            }

            $menu->name = (string) $request->input('name');
            $menu->description = (string) $request->input('description');
            $menu->content = (string) $request->input('content');
            $menu->active = (string) $request->input('active');
            $menu->save();

            Session::flash('success', "Cập nhật thành công danh mục");
            return true;
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
        return true;
    }

    public function getCategoryById($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProductByCate($menu, $request)
    {
        $query =  $menu->products()->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);

        if ($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }
        return $query->orderByDesc('id')->paginate(12)->withQueryString();
    }
}
