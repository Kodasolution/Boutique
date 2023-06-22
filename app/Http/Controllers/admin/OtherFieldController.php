<?php

namespace App\Http\Controllers\admin;

use App\Models\OtherField;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class OtherFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $other = OtherField::orderBy('id', 'desc')->get();
        return view('admin.otherField.index', compact('other'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:other_fields,name',
            'type' => 'required'
        ]);
        OtherField::create([
            "name" => $request->name,
            "type" => $request->type
        ]);
        return back()->with('success', 'other field save successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OtherField $other)
    {
        $data = $request->validate([
            "name" => 'required', Rule::unique('other_fields')->ignore($other->id),
            'type' => 'required'
        ]);
        $other->update([
            'name' => $request->name,
            'type' => $request->type
        ]);
        return back()->with('success', 'other field updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OtherField $other)
    {
        $other->delete();
        return back()->with('success', 'other field deleted successfully');
    }
}
