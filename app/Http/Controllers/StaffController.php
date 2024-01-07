<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Staff::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Fname' => 'required',
            'Lname' => 'required',
            'Email' => 'required',
            'Dept' => 'required',
            'Position' => 'required'
        ]);
        return Staff::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff = Staff::find($id);
        if ($staff != null) {
            return $staff;
        } else {
            return response()->json([
                'No staffmember found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //hitta produkten genomm ID:
        $staff = Staff::find($id);

        //kontrollera att produkten finns: om så är fallet...
        if ($staff != null) {
            //... updateras kursen
            $staff->update($request->all());
            //och returneras.
            return $staff;
        } else {
            return response()->json([
                'Staffmember not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = Staff::find($id);
        if ($staff != null) {
            $staff->delete();
            return response()->json([
                'Staffmember terminated successfully'
            ]);
        } else {
            return response()-> json([
                'staffmember not found'
            ], 404);
        }
    }
}
