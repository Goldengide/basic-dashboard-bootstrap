<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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
        $view = view('role-permission.form-permission')->render();
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

        // Create a new permission
        Permission::create([
            'title' => $request->title,
            'name' => generateSlug($request->title),
        ]);

        // Return a response indicating success
        return back()->with('success', 'Permission successfully created');
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
       //code here
       $permission = Permission::findOrFail($id); // Retrieve the permission by its ID

        // Pass the permission data to the view
        $view = view('role-permission.form-permission', compact('permission'))->render();

        // Return the view as a JSON response
        return response()->json(['data' => $view, 'status' => true]);

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
        //code here
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Find the role by ID
        $permission = Permission::findOrFail($id);

        // Update the role with the new data
        $permission->update([
            'title' => $request->title,
            'name' => generateSlug($request->title), // Assuming generateSlug is a helper function
        ]);
        return back()->with(['success' => "Permission updated successfully"]);
    }
    public function confirmdelete($id)
    {
        $permission = Permission::findOrFail($id); // Assuming you have the role ID in the request data
        $view = view('role-permission.delete-permission', compact('permission'))->render();
        return response()->json(['data' =>  $view, 'status'=> true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the permission by ID
        $permission = Permission::findOrFail($id);
        // Check if the permission is assigned to any user or role
        $usersCount = $permission->users()->count();
        $rolesCount = $permission->roles()->count();

        // If the permission is not assigned to any user or role, delete it
        if ($usersCount == 0 && $rolesCount == 0) {
            // Delete all associated records in the role_permission pivot table
            $permission->roles()->detach();

            // Delete the permission
            $permission->delete();

            // Return a success message
            return back()->with(['success' => "Permission deleted successfully"]);
        } else {
            // Return an error message indicating that the permission cannot be deleted
            return back()->with(['error' => "Permission is assigned to users or roles and cannot be deleted"]);
        }
    }
}
