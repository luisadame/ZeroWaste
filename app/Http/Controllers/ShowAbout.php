<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowAbout extends Controller
{
    /**
     * Show the about page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('about');
    }
}
