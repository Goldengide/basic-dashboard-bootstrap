<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //code here
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $view = view('role-permission.form-role')->render();
        return response()->json(['data' =>  $view, 'status'=> true]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // Validate the request data
       $request->validate([
        'title' => 'required|string|max:255',
    ]);

    // Create a new role
    Role::create([
        'title' => $request->title,
        'status' => $request->status,
        'name' => generateSlug($request->title),
    ]);

    // Return a response indicating success
    return back()->with('success', 'Role successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //code here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id); // Retrieve the permission by its ID

        // Pass the permission data to the view
        $view = view('role-permission.form-role', compact('role'))->render();

        // Return the view as a JSON response
        return response()->json(['data' => $view, 'status' => true]);
    }
    public function confirmdelete($id)
    {
        $role = Role::findOrFail($id); // Assuming you have the role ID in the request data
        $view = view('role-permission.delete-role', compact('role'))->render();
        return response()->json(['data' =>  $view, 'status'=> true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Find the role by ID
        $role = Role::findOrFail($id);

        // Update the role with the new data
        $role->update([
            'title' => $request->title,
            'status' => $request->status,
            'name' => generateSlug($request->title), // Assuming generateSlug is a helper function
        ]);

        // Return a response indicating success
        return back()->with(['success' => "Role updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //code here
    }
}
