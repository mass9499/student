<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\AdminUser;
use Hash;

class AdminUserController extends Controller

{
    public function index()
    {
        $title = "Admins";
        $admins = AdminUser::get();
        return view('admin.admin.index', compact('title', 'admins'));
    }
    public function create()
    {
        $title = "Admins";
        return view('admin.admin.create', compact('title'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate(['email' => 'required|unique:users']);
        $datas = $request->all();
        $datas['password'] = Hash::make($request->password);
        $admin = AdminUser::create($datas);
        return redirect()->route('admins.index')->with('message', 'Successfully Saved.');
    }
    public function edit($admin_user)
    {
        $title = "Admins";
        $admin = AdminUser::where('id', $admin_user)->first();
        return view('admin.admin.edit', compact('title', 'admin'));
    }
    public function update(Request $request, $admin_user)
    {
        $admins = AdminUser::find($admin_user);
        $data = $request->all();
        if($request->new_password)
        {
            if ($request->new_password == $request->confirm_password)
            {
                $data['password'] = Hash::make($request->password);
            }
            else{
                return redirect()->route('admins.edit',[$admin_user])->with('error', 'New password and confirm Password is mismatch.');
            }

        }
       
        $admins->update($data);
        return redirect()->route('admins.index')->with('message', 'Successfully Updated.');
    }
    public function show($admin_user)
    {
    }
    public function destroy($admin_user)
    {
        AdminUser::find($admin_user)->delete();
        return redirect()->route('admins.index')->with('message', 'Successfully Deleted.');
    }

}