<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(8);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(3);
        return view('admin.categories.index', compact('categories'));
    }

    
    public function create()
    {
        $categories;
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:4',
        ]);
        $categories = Category::create($request->only('title', 'description'));
        return back()->with('message', 'Category Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:4',
            'description' => 'min:4'
        ]);
    
        $category = Category::find($id);
        $category->title = $request->get('title');
        $category->description = $request->get('description');
        $category->save();

        return back()->with('message', 'Category Updated Successfully!');
        // $country->updated_by = Auth::user()->username;
    }


    public function recoverCat($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        if($category->restore())
            return back()->with('message','Category Successfully Restored!');
        else
            return back()->with('message','Error Restoring Category');
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->delete()){
            return redirect('/admin/category')->with('message','Category Successfully Trashed!');
        }else{
            return redirect('/admin/category')->with('message','Error Deleting Record');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    // public function bin()
    // {
    //     $deletedCategories = Category::onlyTrashed()->get();
    //     return view('admin.categories.bin', compact('category'));
    // }
}
