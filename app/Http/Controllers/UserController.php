<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getPostByUser($id)
    {
        $contents = $this->user::with('posts')->find($id);

        return view('user.profile', compact('contents'));
    }

    public function getCommentByUser($id)
    {
        $contents = $this->user::with('comments')->find($id);

        return view('user.profile', compact('contents'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index', ['users' => $this->user::with('role')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $password = Hash::make($request->password);
        $role = $request->role_id;

        $user = $this->user;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->role_id = $role;

        $user->save();

        return back()->with('success', 'تم اضافه المستخدم بنجاح');
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
        $user = $this->user::find($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = $this->user->find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        $user->save();

        return back()->with('success', 'تم تعديل معلومات المستخدم');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->user->find($id)->delete();

        return back()->with('success', 'تم حذف المستخدم بنجاح');
    }
}
