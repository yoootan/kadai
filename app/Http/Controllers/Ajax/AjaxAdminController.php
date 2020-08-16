<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Nailist;

class AjaxAdminController extends Controller
{
    public function menu(){

        return Menu::All();
    }
    public function nailist(){

        return Nailist::All();
    }
}
