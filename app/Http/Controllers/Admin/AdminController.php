<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Hash;
use Session;
use Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        if(Auth::check()) {
            return redirect('admin/dashboard');
        }

        return view('admin.login');
    }


    public function login()
    {
        if(Auth::check()) {
            return redirect('admin/dashboard');
        }

        return view('admin.login');
    }

    public function check_login(Request $request)
    {
         $this->validate($request, [
          'email'   => 'required|email',
          'password'  => 'required|min:3'
         ]);
         
         $user_data = array(
              'email'  => $request->get('email'),
              'password' => $request->get('password')
         );

         if(Auth::attempt($user_data))
         {
          return redirect('admin/dashboard');
         }
         else
         {
          return back()->with('error', 'Wrong Login Details');
         }

    }

    public function dashboard()
    {
        if(Auth::check() == "") {
            return redirect('admin/login');
        }
        $title = "Dashboard";
        $a_name = Auth::user()->name;
        
        Session::put('admin_name', $a_name);
         $students = Student::all()->count();

        
        $new_students = Student::where('admin_status','0')->count();
        $students_data = Student::where('admin_status','0')->orderBy('id','desc')->get();               

        return view('admin.dashboard', compact('title', 'students', 'new_students','students_data'));;
    }

    public function change_password()
    {
        $this->middleware('auth');
        $token = Auth::user()->email;
        $title = "Change Password";
        return view('admin/change_password', compact('title'));
    }
    public function update(Request $request)
    {
        $this->middleware('auth');
         $token = Auth::user()->email;
           $this->validate($request, [
             'email'      =>  'email','E-Mail','trim|required',
            'password'      =>  'password','Password','trim|xss_clean|required|min_length[4]|max_length[32]',
        ]);
          $title = "Change Password";
          if($request->password !== $request->password_confirmation){
            Session::flash('message',  "Something Went Wrong, Password Not Changed");
            return view('account/account/change_password', compact('title'));
          }
            $email = Auth::user()->email;
            $users = User::where('email',$request->email)->first();
            if($users){
            $users->password = Hash::make($request->get('password'));
            $users->save();
            }
            else {
        Session::flash('message',  "Something Went Wrong, Password Not Changed");
            }
            return view('account/account/change_password', compact('title'));
    }
    public function destory(){
        // echo 'ddd';die;
        Auth::logout();
        Session::flush();
        return redirect('admin/login');
    }

}