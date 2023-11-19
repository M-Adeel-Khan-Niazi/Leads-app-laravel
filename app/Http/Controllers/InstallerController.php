<?php

namespace App\Http\Controllers;

use App\Models\Installer;
use Illuminate\Http\Request;

class InstallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $installers = Installer::latest()->paginate(10);
        return view('installers.index', compact('installers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('installers.form');
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
            'type' => 'required',
            'phone_number' => 'required',
            'education' => 'required',
        ]);
        Installer::create($request->except('_token'));
        return redirect()->route('installers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Installer $installer
     * @return \Illuminate\Http\Response
     */
    public function show(Installer $installer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Installer $installer
     * @return \Illuminate\Http\Response
     */
    public function edit(Installer $installer)
    {
        $row = $installer;
        return view('installers.form', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Installer $installer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Installer $installer)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'type' => 'required',
            'phone_number' => 'required',
            'education' => 'required',
        ]);
        $installer->fill($request->except('_token', 'id'));
        $installer->save();
        return redirect()->route('installers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Installer $installer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Installer $installer)
    {
        if ($request->ajax()) {
            $installer->delete();
            return response()->json(['deleted' => true]);
        }
        return response()->json(['deleted' => false]);
    }
}
