<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        helper('form');
        $data['error'] = null;
        return view('logging', $data);
    }
}
