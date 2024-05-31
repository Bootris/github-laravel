<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $jobs = Job::where('title', 'LIKE', '%' . $query . '%')
            ->with('employer')
            ->get();

        return view('results', ['jobs' => $jobs]);
    }
}
