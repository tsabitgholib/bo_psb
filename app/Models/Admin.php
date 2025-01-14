<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin'; // Tentukan guard yang digunakan

    // Tambahkan properti dan fungsi lainnya sesuai kebutuhan
}
