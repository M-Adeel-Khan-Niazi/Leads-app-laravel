<?php

namespace App\Http\Controllers;

use App\Models\Funder;
use Illuminate\Http\Request;

class FunderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funders = Funder::latest()->paginate(10);
        return view('funders.index', compact('funders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('funders.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => 'required|unique:funders',
            'address' => 'required',
        ]);
        Funder::create($request->except('_token'));
        return redirect()->route('funders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Funder $funder
     * @return \Illuminate\Http\Response
     */
    public function show(Funder $funder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Funder $funder
     * @return \Illuminate\Http\Response
     */
    public function edit(Funder $funder)
    {
        $row = $funder;
        return view('funders.form', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Funder $funder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funder $funder)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => 'required|unique:funders,email,' . $funder->id,
            'address' => 'required',
        ]);
        $funder->fill($request->except('_token', 'id'));
        $funder->save();
        return redirect()->route('funders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Funder $funder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Funder $funder)
    {
        if ($request->ajax()) {
            $funder->delete();
            return response()->json(['deleted' => true]);
        }
        return response()->json(['deleted' => false]);
    }
}
