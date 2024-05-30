<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function create()
    {
        $recentLinks = Link::latest()->limit(10)->get();

        return view('links.create', ['recentLinks' => $recentLinks]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|unique:links,url',
            'publish_at' => 'required|date',
            'delete_at' => 'required|date|after:publish_at',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $link = Link::create([
            'internal_id' => $this->generateRandomString(7),
            'url' => $request->input('url'),
            'publish_at' => $request->input('publish_at'),
            'delete_at' => $request->input('delete_at'),
        ]);

        return redirect()->back()->with('success', 'Link created successfully.');
    }

    private function generateRandomString($length = 7)
    {

        return Str::random($length);

    }
}
