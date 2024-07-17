<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
	{
        $categories = Category::get();
		//dd($users[0]->toArray());
		if (!$request->ajax()) return view();
		return response()->json(['categories' => $categories], 200);
	}


	public function create()
	{
		// view
	}


	public function store(Request $request)
	{
        $category = new Category($request->all());
        $category->save();
        return response()->json([], 200);
	}


	public function show()
	{
	}

	public function edit($id)
	{
		// View
	}


	public function update()
	{
	}

	public function destroy()
	{
	}
}
