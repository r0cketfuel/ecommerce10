<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Banner\StoreBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;

use App\Models\Banner;

class BannerController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        $banners = Banner::vigentes();

        return view("admin.banners.index", compact('banners'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function create()
    {
        return view("admin.banners.create");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreBannerRequest $request)
    {
        $banner = new Banner;
        $banner = Banner::make($request->validated());
        $banner->save();

        return redirect()->route('banners.index')->with('success', 'Banner creado exitosamente');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show($id)
    {
        if(is_numeric($id))
        {
            $banner = Banner::detalle($id);

            return view("admin.banners.show", compact('banner'));
        }

        return redirect()->route('admin.dashboard')->with('danger', 'Error');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function edit(Banner $banner)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Banner $banner)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
