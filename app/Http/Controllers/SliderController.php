<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('dashboardpage.denah.index', compact('sliders'));
    }

    public function create()
    {
        return view('dashboardpage.denah.create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|string|min:5',
            'caption' => 'required|string|min:5',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);
        $validator['image'] = $request->file('image')->store('img-slide');
        $saveData = Slider::create($validator);
        return redirect()->route('dashboardpage.denah.index')->with('success', "Data berhasil ditambahkan");
    }
    // TOLOL BANGET YG NGODING SIAPASI ANYING

    public function edit(Request $request, $id)
    {
        $slider = Slider::find($id);
        return view('dashboardpage.denah.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'title' => 'required|string|min:5',
            'caption' => 'required|string|min:5',
            'image' => 'image|mimes:jpeg,png,jpg,webp',
        ]);

        if($request->file('image')) {
            if($request->old_img) {
                Storage::delete($request->old_img);
            }
            $request['image'] = $request->file()->store('img-slide');
        }
        $updateData = Slider::find($id)->update($validator);
        return redirect()->route('dashboardpage.denah.index');
    }
    public function destroy($id)
    {
        $slider = Slider::find($id);
        Storage::delete('public/slider/'.$slider->image);
        $slider->delete();
        return redirect()->route('dashboardpage.denah.index');
    }
}
