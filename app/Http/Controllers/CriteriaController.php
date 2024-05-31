<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('criteria.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Categories = Category::query()->get(['title', 'category_id']);

        return view('criteria.create', compact([
            'Categories'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'points' => 'required',
            'category' => 'required',
        ]);

        // get the category id
        $Category = Category::query()->where('category_id', '=', $request->input('category'))->first(['id', 'title']);

        // add the record to the database
        Criteria::query()->create([
            'name' => $request->input('name'),
            'points' => $request->input('points'),
            'category' => $request->input('category'),
        ]);

        // redirect back to the page
        return redirect()->route('criteria.create')->with('success', '' . $request->name . ' is added in the'. $Category->title);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('criteria.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('criteria.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Criteria = Criteria::query()->where('id', '=', $id)->first();

        if ($Criteria == null) {
            return redirect()->route('category.index')->with('info', 'nothing to delete in the records.');
        }

        // delete the cadidate in the records
        $Criteria->delete();

        // redirect back to the page
        return redirect()->route('category.index')->with('success', '' . $Criteria->name . ' is deleted in the records.');
    }

    public function destroy_criteria(string $id)
    {
        $Criteria = Criteria::query()->where('id', '=', $id)->first();
        $criteria_name = $Criteria->name;

        if ($Criteria == null) {
            return redirect()->route('category.index')->with('info', 'nothing to delete in the records.');
        }

        // delete the cadidate in the records
        $Criteria->delete();

        // redirect back to the page
        return redirect()->route('category.index')->with('success', $criteria_name . ' is deleted in the records.');
    }
}
