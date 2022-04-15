<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helpers
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                <tr>
                    <td>' . $menu->id . '</td>
                    <td>' . $char . $menu->name . '</td>
                    <td>' . self::active($menu->active) . '</td>
                    <td>' . $menu->updated_at . '</td>
                    <td>
                        <a href="/admin/menus/edit/' . $menu->id . '" class="btn btn-primary btn-sm>
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                            onclick="removeRow(' . $menu->id . ', \'/admin/menus/destroy\')"
                        >
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char . $menu->name . ' -- ');
            }
        };
        return $html;
    }

    public static function active($active = 0): string
    {
        return $active == 0 ? '<span class="btn btn-danger">NO</span>' :
            '<span class="btn btn-success">YES</span>';
    }

    public static function getMenuToHeader($menus, $parent_id = 0): string
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <li>
                         <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '">

                            ' . $menu->name . '
                        </a>
                ';

                unset($menus[$key]);

                if (self::isChildMenu($menus, $menu->id)) {

                    $html .= '<ul class="sub-menu">';
                    $html .= self::getMenuToHeader($menus, $menu->id);
                    $html .= '</ul>';
                }

                $html .= '</li>';
            }
        }
        return $html;
    }

    public static function isChildMenu($menus, $id): bool
    {
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }
        return false;
    }

    public static function getPrice($price = 0, $price_sale = 0)
    {
        if ($price_sale != 0) return number_format($price_sale);
        if ($price != 0) return number_format($price);

        return '<a href="/lien-he.html">Liên hệ</a>';
    }
}
