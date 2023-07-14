<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    public function index() {
        $short_links = ShortLink::paginate(10);

        return view('short_links', compact('short_links'));
    }

    public function store(Request $request) {
        $request->validate([
            'link' => 'required | url | unique:short_links'
        ]);

        $data['link'] = $request->link;
        $data['code'] = Str::random(6);

        ShortLink::create($data);

        return redirect('/')->with('success', 'Link Genereated Successfully.');
    }

    public function show($code) {
        $data = ShortLink::where('code', $code)->firstOrFail();
        $data->visit_count += 1;
        $data->save();

        return redirect($data->link);
    }

    public function destroy($code) {
        $data = ShortLink::where('code', $code)->firstOrFail();
        $data->delete();

        return redirect('/')->with('danger', 'Link deleted successfully.');
    }
}
