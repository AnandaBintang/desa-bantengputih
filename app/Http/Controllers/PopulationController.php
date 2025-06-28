<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PopulationController extends Controller
{
    /**
     * Display the population index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.populations.index');
    }
}
