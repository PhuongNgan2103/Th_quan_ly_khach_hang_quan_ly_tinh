<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //
    public function customers(){
        return $this->hasMany('App\Customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $cities = City::all();
        return view('cities.list', compact('cities'));
    }

    private function hasMany(string $string)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $city = new City();
        $city->name     = $request->input('name');
        $city->save();

        //tao moi xong quay ve trang danh sach khach hang
        return redirect()->route('customers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id){
        $city = City::findOrFail($id);
        return view('cities.edit', compact('city'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id){
        $city = City::findOrFail($id);

        //xoa khach hang thuoc tinh thanh nay
        $city->customers()->delete();
        $city->delete();

        //cap nhat xong quay ve trang danh sach tinh thanh
        return redirect()->route('cities.index');
    }

}
