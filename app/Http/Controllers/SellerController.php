<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Seller;
use App\Category;
use Validator;

class SellerController extends Controller
{
    
    public function index()
    {
        $sellers = Seller::with('category')->get();
		
		return view('pages.index', ['sellers' => $sellers]);
    }

    public function create()
    {
        $categories = Category::all();
		
		return view('pages.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $rules = array(
			'name' => 'required',
			'category' => 'exists:categories,id',
			'address' => 'required|min:3',
			'email' => 'required|email',
			'phone' => 'required'
		);
		
		$validator = Validator::make($request->all(), $rules);
		
		if ($validator->fails()) {
			return redirect()->action('SellerController@create')
				->withErrors($validator)
				->withInput();
		} else {
			$seller = new Seller;
			$seller->name = $request->input('name');
			$seller->category_id = $request->input('category');
			$seller->address = $request->input('address');
			$seller->email = $request->input('email');
			$seller->phone = $request->input('phone');
			$seller->save();
			
			return redirect()->action('SellerController@index')->with('success', trans('alerts.seller.store.success'));
		}
		
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $seller = Seller::where('id', $id);
		$seller->delete();
		
		return redirect()->action('SellerController@index')->with('success', trans('alerts.seller.destroy.success'));
    }
}
