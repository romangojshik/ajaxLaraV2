<?php
/**
 * Created by PhpStorm.
 * User: Roman
 * Date: 15.11.17
 * Time: 22:12
 */

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;

class AccountController
{
    public function index()
    {
        return view('account.index');
    }
}