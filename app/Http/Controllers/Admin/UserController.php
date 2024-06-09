<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required'],
            'role' => ['required', 'string', 'max:255', 'in:admin,user'],
            'image' => ['nullable', 'image', 'max:5000'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        if ($request->hasFile('image')) {
            $user->avatar = $this->uploadImage($request,'image');
        }
        $user->save();
        return redirect()->route('admin.user.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view('admin.user.update',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'role' => ['required', 'string', 'max:255', 'in:admin,user'],
            'image' => ['nullable', 'image', 'max:5000'],
        ]);
        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->role = $request->role;
        if ($request->hasFile('image')) {
            $users->avatar = $this->uploadImage($request,'image');
        }
        $users->save();
        return redirect()->route('admin.user.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       try{
            $users = User::findOrFail($id);
            $users->delete();
            return response(['status'=>'success','message'=>'delete successfully']);
       }catch(\Exception $e){
           toastr($e->getMessage(),'error');
           return response(['status'=>'error','message'=>$e->getMessage()]);
       }
    }
}
