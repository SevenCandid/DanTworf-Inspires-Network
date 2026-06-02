<?php

namespace App\Controllers;

use App\Core\Session;

class AdminBaseController {
    public function __construct() {
        Session::start();
        if (!Session::has('user_id') || Session::get('user_role') !== 'admin') {
            header("Location: /DIN/public/login");
            exit;
        }
    }
}
