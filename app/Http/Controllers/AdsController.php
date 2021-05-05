<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdsController extends Controller
{
    public function index() {
        $adsList = Ads::all();

        return view('admin.ads.index', compact('adsList'));
    }

    public function store(Request $request) {


        $validated = $request->validate([
            'ads' => 'required|image|mimes:jpg,jpeg|max:2048|dimensions:min_width=500,min_height=600',
        ]);

        $path = $validated['ads']->store('public/ads');

        if($path) {
            $ads = Ads::create(['name' => $path]);

            if($ads) {
                return redirect()->back()->with('success', 'Ads has been uploaded');
            }
        }
    }

    public function delete($id) {
        $ad = Ads::find($id);

        

        if($ad->id) {
            if(File::exists($ad->name)) {
                File::delete($ad->name);
            }
            Ads::destroy($ad->id);
            return redirect()->back()->with('success', 'Ads successfully deleted');
        } else {
            return redirect()->back()->with('error', 'Ads not found');
        }
    
    }
}
