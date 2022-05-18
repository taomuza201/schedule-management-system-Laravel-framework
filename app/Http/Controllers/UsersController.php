<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Districts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $you = auth()->user();
        $users = User::select('*')->join('districts', 'users.districts_id', '=', 'districts.districts_id')
        ->join('faculties', 'districts.faculties_id', '=', 'faculties.faculties_id')
        ->get();
        return view('dashboard.admin.usersList', compact('users', 'you'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('dashboard.admin.userShow', compact( 'user' ));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'       => 'required|min:1|max:256',
            'email'      => 'required|email|max:256'
        ]);
        $user = new User();
        $user->name       = $request->input('name');
        $user->email      = $request->input('email');
        $user->tel      = $request->input('tel');
        $user->districts_id       = $request->districts_id;
        $user->menuroles       = $request->menuroles;
        $user->password       =   Hash::make($request->password);
        $user->assignRole($request->menuroles);
        $user->save();
        
        return redirect()->route('users.index')->withsuccess(__('เพิ่มไขข้อมูลสำเร็จ.'));
   
    
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $districts = Districts::all();
        $roles = DB::table('roles')->select('*')->get();
        return view('dashboard.admin.userEditForm', compact('user','districts','roles'));
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
        

        $validatedData = $request->validate([
            'name'       => 'required|min:1|max:256',
            'email'      => 'required|email|max:256'
        ]);
        $user = User::find($id);
        $user->name       = $request->input('name');
        $user->email      = $request->input('email');
        $user->tel      = $request->input('tel');
        $user->districts_id       = $request->districts_id;
        $user->menuroles       = $request->menuroles;
        if($request->password != ''){
            $user->password       =   Hash::make($request->password);
        }
        $user->syncRoles($request->menuroles);
        $user->save();
        return redirect()->route('users.index')->withsuccess(__('แก้ไขข้อมูลสำเร็จ.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
        }
        return redirect()->route('users.index')->withsuccess(__('ลบข้อมูลสำเร็จ.'));
    
    }
}
