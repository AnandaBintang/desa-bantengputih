<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $village = Village::getMainVillage();

        return view('pages.contact.index', compact('village'));
    }
}
