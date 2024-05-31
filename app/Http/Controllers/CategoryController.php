<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Criteria;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories = Category::query()->get();

        // get the criteria list of this category
        $Criterias = Criteria::query()->get();

        return view('category.list', compact(['Categories', 'Criterias']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'criteria_name' => 'required',
            'points' => 'required',
        ]);

        // dd($request->input('criteria_name')[1]);

        // generate judge id
        $category_id = fake()->numerify('0###');

        // add the record to the database
        Category::query()->create([
            'category_id' => $category_id,
            'title' => $request->input('title'),
        ]);
        for ($i = 0; $i < count($request->input('criteria_name')); $i++) {
            Criteria::query()->create([
                'name' => $request->input('criteria_name')[$i],
                'points' => $request->input('points')[$i],
                'category' => $category_id,
            ]);
        }

        // redirects to the results page
        return redirect()->route('category.index')->with('success', 'New Category (' . $request->title . ') added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($id > 0) {
            $Category = Category::query()->where('id', '=', $id)->first();

            // get the criteria list of this category
            $Criterias = Criteria::query()->where('category', '=', $Category->category_id)->get();
        } else {
            $Category = [
                'id' => 0,
                'title' => 'Title',
                'category_id' => '#000',
            ];

            $Criterias = [
                [
                    'id' => 0,
                    'name' => 'Name',
                    'points' => '00',
                ],
            ];
        }

        // dd($Criterias);

        return view('category.show', compact([
            'Category',
            'Criterias',
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // if ($id > 0) {
        //     $Category = Category::query()->where('id', '=', $id)->first();
        // } else {
        //     $Category = [
        //         'id' => 0,
        //         'title' => 'Title',
        //         'category_id' => '#000',
        //     ];
        // }

        $category = Category::query()->where('id', '=', $id)->first();
        $criterias = Criteria::query()->where('category', '=', $category->category_id)->get();

        return view('category.edit', compact([
            'category',
            'criterias',
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        // dd($request->input());

        // $Category = Category::query()->where('id', '=', $id)->first();

        // if ($Category == null) {
        //     return redirect()->route('category.index')->with('info', 'nothing to update in the records.');
        // } 
        // else if ($Category->title == $request->input('title')) {
        //     return redirect()->route('category.index')->with('info', 'Category Title already istablished.');
        // }

        // generate judge id
        // $category_id = $Category->category_id;

        // add the record to the database
        $cat_old = Category::query()->where('id', '=', $id)->first();
        $category = Category::query()->where('id', '=', $id)->update([
            'title' => $request->input('title'),
        ]);

        // add criteria if there is one
        if ($request->input('cri_id') != null) {
            for ($i = 0; $i < count($request->input('cri_id')); $i++) {
                if ($request->input('cri_id')[$i] != null) {
                    Criteria::query()->where('id', $request->input('cri_id')[$i])->update([
                        'name' => $request->input('criteria_name')[$i],
                        'points' => $request->input('points')[$i],
                        // 'category' => $cat_old->category_id,
                    ]);
                } else {
                    Criteria::query()->create([
                        'name' => $request->input('criteria_name')[$i],
                        'points' => $request->input('points')[$i],
                        'category' => $cat_old->category_id,
                    ]);
                }
            }
        }


        // redirects to the results page
        return redirect()->route('category.index')->with('success', 'Category (' . $cat_old->title . ') updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Category = Category::query()->where('id', '=', $id)->first();

        if ($Category == null) {
            return redirect()->route('category.index')->with('info', 'nothing to delete in the records.');
        }

        // delete the cadidate in the records
        $Category->delete();

        // redirect back to the page
        return redirect()->route('category.index')->with('success', '' . $Category->firstname . ' is deleted in the records.');
    }
}
