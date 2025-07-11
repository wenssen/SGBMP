<?php

use Illuminate\Support\Facades\Auth;

function esAdmin(): bool
{
    return Auth::check() && Auth::user()->rol === 'admin';
}

