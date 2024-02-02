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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5',
            'caption' => 'required|string|min:5',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $imageName = time().'.'.$request->image->extension();
        Storage::putFileAs('public/slider', $request->file('image'), $imageName);
        $slider = Slider::create([
            'title' => $request->title,
            'caption' => $request->caption,
            'image' => $imageName,
        ]);
        return redirect()->route('dashboardpage.denah.index');
    }

    public function edit(Request $request, $id)
    {
        $slider = Slider::find($id);
        return view('dashboardpage.denah.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:5',
            'caption' => 'required|string|min:5',
            'image' => 'image|mimes:jpeg,png,jpg,webp',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        if ($request->hasFile('image')) {
            $old_image = Slider::find($id)->image;
            Storage::delete('public/slider/'.$old_image);
            $imageName = time().'.'.$request->image->extension();
            Storage::putFileAs('public/slider', $request->file('image'), $imageName);
            Slider::where('id', $id)->update([
                'title' => $request->title,
                'caption' => $request->caption,
                'image' => $imageName,
            ]);

        } else {
            Slider::where('id', $id)->update([
                'title' => $request->title,
                'caption' => $request->caption,
            ]);
        }
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
