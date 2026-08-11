<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function notFound()
    {
        // Optional: Fetch dynamic data here
        return response()->view('errors.404', [], 404);
    }

}
