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
    
    public function index(Request $request)
    {
        $sellers = Seller::with('category')->get();
		
		if ($request->isJson())
		{
			return response()->json($sellers);
		}
		else
		{
			return view('pages.index', ['sellers' => $sellers]);
		}
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

    public function show(Request $request, $id)
    {
        $seller = Seller::with('category')->where('id', $id)->first();
		
		if ($request->isJson())
		{
			return response()->json($seller);
		}
		else
		{
			return view('pages.show', ['seller' => $seller]);
		}
    }

    public function edit($id)
    {
        $seller = Seller::where('id', $id)->first();
		$categories = Category::all();
		
		return view('pages.edit', ['seller' => $seller, 'categories' => $categories]);
    }

    public function update(Request $request)
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
			return redirect()->back()->withErrors($validator);
		} else {
		
			$seller = Seller::find($request->input('seller_id'));
			
			if ($seller->count()) {
				$seller->name = $request->input('name', $seller->name);
				$seller->category_id = $request->input('category_id', $seller->category_id);
				$seller->phone = $request->input('phone', $seller->phone);
				$seller->address = $request->input('address', $seller->address);
				$seller->email = $request->input('email', $seller->email);
				$seller->save();
				
				return redirect()->action('SellerController@index')->with('success', trans('alerts.seller.update.success'));
			} else {
				return App::abort(404);
			}
		
		}
    }

    public function destroy($id)
    {
        $seller = Seller::where('id', $id);
		$seller->delete();
		
		return redirect()->action('SellerController@index')->with('success', trans('alerts.seller.destroy.success'));
    }
}
