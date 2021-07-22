<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Setting;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Query;
use App\Models\University;
use App\Models\Invoice;
use Hash;
use Session;
use Auth;
use DB;
use Response;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        
    }
    public function index(Request $request)
    {
        if (Session::get('student_id') != "")
        {
            return redirect('dashboard');
        }
        if ($request->isMethod('post'))
        {
            $this->validate($request, ['email' => 'required', 'password' => 'required', ]);
            $email = $request->email;
            $password = $request->password;
            //pr($email); die;
            $user = Student::where("email", $email)->first();
            if ($user)
            {
                //pr($user);die;
                Hash::check($request->password, $user->password);
                if (Hash::check($password, $user->password))
                {
                   
                    Session::put('student_id', $user->id);
                    Session::put('first_name', $user->first_name);
                    Session::put('student_code', $user->student_code);
                    Session::flash('success', 'Login Success.');
                    return redirect('dashboard')
                        ->with('success', 'Login Success.');
                }
                else
                {
                    Session::flash('error', 'Password Does not Match.');
                    return redirect('/');
                }
            }
            else
            {
                // echo "sssss";
                // die;
                Session::flash('error', 'Email Does not Match.');
                return redirect('/');
            }
        }
        $title = "Login";
        return view('frontend.login', compact('title'));
    }
    public function registration(Request $request)
    {
        if (Session::get('student_id') != "")
        {
            return redirect('dashboard');
        }
        if ($request->isMethod('post'))
        {
            $validatedData = $request->validate(['email' => 'required|unique:students']);
            $datas = $request->all();
             $mail_password = $datas['password'];
            $datas['password'] = Hash::make($request->password);

            $student = Student::create($datas);

            $data['student_id'] = $student->id;
            $student_code = "ASEC" . str_pad($student->id, 4, "0", STR_PAD_LEFT);
            $track_id = "TRACK" . time();
            $data = array(
                'student_code' => $student_code,
                'track_id' => $track_id
            );
            $student->update($data);
          
            //Reply To User Mail after Registration
            $mail = $request->email;
            $student_email = $mail;
            $subjects = "Your Registration Details";
            $setting = Setting::first();
            $htmls = view('student_register_mail', compact('setting', 'datas', 'student_code', 'track_id', 'mail_password'))->render();


            // Always set content-type when sending HTML email
            $headers_ = "MIME-Version: 1.0" . "\r\n";
            $headers_ .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers_ .= 'From: '.$setting->company_name.' <' . $setting->company_email . '>' . "\r\n";
            mail($student_email, $subjects, $htmls, $headers_);
            return redirect('/')->with('message', 'Your profile has been created successfully.');
        }
        $title = "Register";
        return view('frontend.register', compact('title'));
    }
    public function track_by_id(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $track_id = $request->track_id;
            $title = "Tracking Details";
            $student = Student::where('track_id', $track_id)->first();
            if ($student)
            {
                $university_data = University::where('student_id', $student->id)
                    ->get();
                return view('frontend.tracking_details', compact('title', 'student', 'university_data'));
            }
            else
            {
                Session::flash('error', 'Invalid Tracking ID!');
            }
        }
        $title = "Track";
        return view('frontend.tracking', compact('title'));
    }
    public function login()
    {
        if (Session::get('student_id') != "")
        {
            return redirect('/');
        }
        return view('frontend.login');
    }
    public function dashboard()
    {
        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }
        $title = "Dashboard";
        $id = Session::get('student_id');
        $student = Student::where('id', $id)->first();
        $university_data = University::where('student_id', $id)->get();
        $offer_letters = University::where('student_id', $id)->whereNotNull('offer_letter')->get();
        return view('frontend.dashboard', compact('title', 'student', 'university_data','offer_letters'));
    }
    public function documents()
    {
        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }
        $title = "Dashboard";
        $id = Session::get('student_id');
        $student = Student::where('id', $id)->first();
        $document_types = DocumentType::get();
        $documents = Document::
                        select('documents.*','dt.document_name  as document_type_name')
                        ->leftJoin('document_type as dt', 'dt.id', '=', 'documents.document_type')
                        
                        ->where('student_id', $id)->get();
        // dd( $documents);
        return view('frontend.documents', compact('title', 'student', 'documents', 'document_types', 'id'));
    }
    public function documents_update(Request $request)
    {
        // return $request;

        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }

        $id = Session::get('student_id');
        $data = $request->all();
        $files = @$request->file('document');
        if ($files)
        {
            foreach ($files as $key => $file)
            {
                if($file){
                    $data_docuemnt = array();
                    $doc_id = $request->doc_id[$key];
                    $file = @$request->file('document') [$key];
                    $document_type = @$request->document_type[$key];
                    $name = "document-" . time() . rand(1000, 200000);
                    $file->move(public_path() . '/documents/', $name);
                    $data_docuemnt['document'] = $name;
                    $data_docuemnt['document_name'] = $file->getClientOriginalName();
                    $data_docuemnt['document_type'] = $document_type;
                    $data_docuemnt['student_id'] = Session::get('student_id');
                    if ($doc_id){
                        Document::where('id', $doc_id)->update($data_docuemnt);
                    }
                    else{
                        Document::create($data_docuemnt);
                    }   
       
                }
            }
        }
        return redirect('documents')->with('message', 'Successfully Updated.');
    }

    public function invoice()
    {

        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }

        $title = "Invoice List";
        $id = Session::get('student_id');
        $invoice = Invoice::where('student_id', $id)->get();
        return view('frontend.invoice_list', compact('title', 'invoice'));
    }

    public function invoice_download($id)
    {

        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }

        $ids = explode("-", $id);
        $invoice = Invoice::where('id', $ids[1])->where('student_id', $ids[2])->first();

        if($invoice){
            $file = $invoice->invoice_file_name;
             
            if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)){
                    $filepath = "public/invoice/" . $file;
                  
                    // Process download
                    if(file_exists($filepath)) {
                        
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($filepath));
                        flush(); // Flush system output buffer
                        readfile($filepath);
                
                    } else {
                        echo "failed";
        
                    }
                } else {
                    //die("Invalid file name!");
                }

        }
        return redirect("invoice");
    }

    public function offer_letter()
    {
        $title = "Offer Letter";
        $id = Session::get('student_id');
        $offer_letters = University::where('student_id', $id)->get();
        // return $offer_letters;
        return view('frontend.offer_letter', compact('title', 'offer_letters'));
    }
    public function offer_letter_download($id)
    {
        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }

        $student_id = Session::get('student_id');
        $offer_letters = University::where('id', $id)->where('student_id',$student_id)->first();
        //$download = public_path() . '/documents/' . $offer_letters->offer_letter;
        

         $file = $offer_letters->offer_letter;
         $offer_letter_file_name = $offer_letters->offer_letter_name;


                 $filepath = "public/documents/" . $file;
            
                // Process download
                //echo basename($offer_letter_file_name); die;
                if(file_exists($filepath)) {
                    
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="'.basename($offer_letter_file_name).'"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($filepath));
                    flush(); // Flush system output buffer
                    readfile($filepath);
            
                } else {
                    echo "failed";
    
                }
            

            die;

    }
    public function profile()
    {
        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }

        $title = "Profile";
        $id = Session::get('student_id');
        $student = Student::where('id', $id)->first();
        return view('frontend.profile', compact('title', 'student'));
    }
    public function profile_update(Request $request)
    {
        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }
        $id = Session::get('student_id');
        $this->validate($request, ['email' => 'unique:students,email,' . $id,   ]);
        $data = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'dob' => $request->dob
        );
        Student::where('id', $id)->update($data);
        Session::flash('message', 'Profile Successfully updated.');
        return redirect('profile');
    }

     public function notification()
    {
        if (Session::get('student_id') == "")
        {
            return false;
            die;
        }
        $title = "Queries";
        $id = Session::get('student_id');
        $querys = Query::select('q.*', 'students.student_code', 'students.first_name')
            ->from(DB::raw('(select * from queries WHERE user_id = '.$id.' order by id desc  LIMIT 18446744073709551615 )as  q ') )
            ->join('students', 'students.id', '=', 'q.user_id')
            ->where('user_notification', 0)
            ->where('q.user_id',$id)
            ->orderBy('q.id','desc')->get();
        $querys_count = count($querys);
        $querys_data = $querys;
        $data = array();
        $data['count'] = $querys_count;
        $data['data'] = array();
        foreach ($querys_data as $key => $value) {
           $data['data'][] = array(
                        'description'   => substr($value->message,0,100)."...",
                        'url'           => url('queries/'),
                        'id'            => $value->id
           ); 
        }

        return Response::json($data);
    }

    public function notification_close($id)
    {   
        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }
        $user_id = Session::get('student_id');
        $data2 = array('user_notification' => 1);
        Query::where('user_id', $user_id)->where('id', $id)->update($data2);

    }

    public function queries()
    {
        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }
        $title = "Queries";
        $id = Session::get('student_id');
        $student = Student::where('id', $id)->first();
    
        $querys = Query::select('queries.*', 'students.student_code', 'students.first_name')->join('students', 'students.id', '=', 'queries.user_id')
            ->where('user_id', $id)->get();

        $data = array('student_read_status' => 1);
        Query::where('student_read_status', 0)->where('user_id', $id)->update($data);

        $data2 = array('user_notification' => 1);
        Query::where('user_notification', 0)->where('user_id', $id)->update($data2);


        return view('frontend.queries', compact('title', 'student', 'querys'));
    }
    public function queries_store(Request $request)
    {
        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }
        //return $request;
        $id = Session::get('student_id');
        $query = new Query;
        $query->user_id = $id;
        $query->type = 1;
        $query->message = $request->message;
        $query->student_read_status =1;
        $query->user_notification = 1;
        $query->save();
        Session::flash('message', 'Query Added Successfully.');
        return redirect('queries');
    }
    public function change_password()
    {
        $this->middleware('auth');
        // $token = Auth::user()->email;
        $title = "Change Password";
        return view('frontend/change_password', compact('title'));
    }
    public function change_password_post(Request $request)
    {
        if (Session::get('student_id') == "")
        {
            return redirect('/');
        }
        $data = $request->all();
        $old_password = $data['old_password'];
        $new_password = $data['new_password'];
        $cnew_password = $data['cnew_password'];
        $id = Session::get('student_id');
        $student = Student::where('id', $id)->first();
        $check = Hash::check($old_password, $student->password);
        if ($check)
        {
            if ($new_password == $cnew_password)
            {
                $password = Hash::make($new_password);
                Student::where('id', $id)->update(array(
                    'password' => $password
                ));
                Session::flash('success', 'Changed Password Successfully');
                return redirect('change_password');
            }
            else
            {
                Session::flash('error', 'Mismatch New Password');
                return redirect('change_password');
            }
        }
        else
        {
            Session::flash('error', 'Wrong Old Password');
            return redirect('change_password');
        }
    }
    public function forget_password()
    {
        
        $title = "Forget Password";
        return view('frontend/forget_password', compact('title'));
    }
    public function forget_password_post(Request $request)
    {
        
        $data = $request->all();
        $email = $data['email'];
        $student = Student::where('email', $email)->first();
        if ($student)
        {
            $setting = Setting::first();
            $otp = mt_rand(1000000000000, 99999999999999);
            Student::where("email", $email)->update(['otp' => $otp]);
            $student_otp = Student::where("otp", $otp)->first();
            $subject = "Reset Password Link";
            $html = view('forget_password_link', compact('setting', 'student', 'student_otp'))->render();
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <' . $setting->company_email . '>' . "\r\n";
            mail($email, $subject, $html, $headers);
            Session::flash('success', 'Please check your email. We sent reset password link.');
            return redirect('forget_password');
        }
        else
        {
            Session::flash('error', 'Email does not exits.');
            return redirect('forget_password');
        }
    }
    public function reset_password($otp)
    {
        
        $student = Student::where("otp", $otp)->first();
        if ($student)
        {
            $title = "Reset Password";
            return view('frontend/reset_password', compact('title', 'student'));
        }
        else
        {
            Session::flash('error', 'Link Expired.');
            return redirect('forget_password');
        }
    }
    public function reset_password_post(Request $request)
    {
        
        $data = $request->all();
        if ($data['password'] == $data['cpassword'])
        {
            Student::where('otp', $data['otp'])->update(array(
                'password' => Hash::make($data['password'])
            ));
            Session::flash('success', 'Your Password is reset successfully. Please login');
            Session::flash('message', 'Your Password is reset successfully. Please login');
            return redirect('/');
        }
        else
        {
            Session::flash('error', 'Password does not match.');
            return redirect('reset_password/' . $data['otp']);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}