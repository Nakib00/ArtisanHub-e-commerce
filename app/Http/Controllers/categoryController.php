<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;

class categoryController extends Controller
{
    //Open the category page
    public function category()
    {
        $categorys = category::all();
        return view('admin.category.category', ['categorys' => $categorys]);
    }

    public function categorysaller()
    {
        $categorys = category::all();
        return view('saller.category.category', ['categorys' => $categorys]);
    }

    //Add new category
    public function categoryStore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:1,0',
        ]);

        // Create and save the category
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['name']);
        $category->status = $validatedData['status'];
        $category->save();

        // Return response
        return redirect()->back()->with('success', 'Category added successfully');
    }

    //Change category satatus
    public function changestatus($id, $status)
    {
        $category = Category::findOrFail($id);
        $category->status = $status;
        $category->save();

        return redirect()->back()->with('success', 'Category status changed successfully.');
    }

    //Edit category
    public function updateCategory($id, Request $request)
    {

        $data = $request->validate([
            'name' => 'required|max:255|string',
        ]);

        // Generate a unique slug based on the name
        $slug = Str::slug($data['name']);

        // Check if the slug already exists
        if (Category::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            return redirect()->back()->with('error', 'Category with this name already exists.');
        }

        // Update the category data
        $category = Category::findOrFail($id);
        $category->update($data);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }
    //Delete a category
    public function delete($id)
    {
        $category = category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Delete Category successfully.');
    }
}
