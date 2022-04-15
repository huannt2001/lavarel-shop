<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;

class CateController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index(Request $request, $id, $slug = '')
    {
        $menu = $this->menuService->getCategoryById($id);
        $products = $this->menuService->getProductByCate($menu, $request);

        return view('menu', [
            'title' => $menu->name,
            'products' => $products,
            'menu' => $menu
        ]);
    }
}
