<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Student;
use App\Models\Setting;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\University;
use App\Models\Invoice;
use App\Models\InvoiceExtras;
use App\Http\Controllers\Admin\InvoiceController;
use Hash;
use Session;
use DB;

class StudentController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $title = "Students";
         // $students = Student::
         //        select('students.*','ud.action_date',
         //            DB::raw('count(ud.id)  as university_count'),

         //            DB::raw('GROUP_CONCAT( IF(ud.university_name IS NULL, "", ud.university_name)) university_names'),

         //            DB::raw('GROUP_CONCAT( IF(ud.action_date IS NULL, "", ud.action_date)) action_dates'),
         //            DB::raw('GROUP_CONCAT( IF(ud.application_date IS NULL, "", ud.application_date)) application_dates'),
         //            DB::raw('GROUP_CONCAT( IF(ud.application_id IS NULL, "", ud.application_id)) application_ids')
         //        )
         //        ->leftJoin(DB::raw('(select * from university_details   order by ISNULL(action_date) , action_date ASC  LIMIT 18446744073709551615 )as ud'), 'ud.student_id', 'students.id')
         //        ->orderBy(DB::raw('(ud.action_date IS NULL), ud.action_date'),'ASC')
         //        ->groupBy('students.id')
         //        ->get();
        //$students = Student::get();
        //dd($students);
        $students =  array();
        return view('admin.student.index', compact('title', 'students'));
    }

    public function ajax(Request $request) {

        $columns = array( 
                            0 =>'id', 
                            1 =>'university',
                            2 =>'student_code',
                            3 =>'first_name',
                            4 =>'phone_number',
                            5 =>'email',
                            6 =>'action_date',
                            7 =>'updated_at',
                            8 =>'action',
                        );
  
        $totalData = Student::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
                  
            $students =  $fliter_student = Student::
                select('students.*',
                    'ud.action_date',
                    'ud.updated_at as university_updated_at',
                    DB::raw('count(ud.id)  as university_count'),

                    DB::raw('GROUP_CONCAT( IF(ud.university_name IS NULL, "", ud.university_name)) university_names'),

                    DB::raw('GROUP_CONCAT( IF(ud.action_date IS NULL, "", ud.action_date)) action_dates'),
                    DB::raw('GROUP_CONCAT( IF(ud.application_date IS NULL, "", ud.application_date)) application_dates'),
                    DB::raw('GROUP_CONCAT( IF(ud.application_id IS NULL, "", ud.application_id)) application_ids')
                )
                ->leftJoin(DB::raw('(select * from university_details   order by ISNULL(action_date) , action_date ASC  LIMIT 18446744073709551615 )as ud'), 'ud.student_id', 'students.id')
                
               
                ->groupBy('students.id');

               


                 if(@$request->input('search.value'))
                    { 
                        $search = $request->input('search.value');
                        $students = $students->where('students.id','LIKE',"%{$search}%");
                        $students =  $students->orWhere('students.first_name', 'LIKE',"%{$search}%");
                        $students =  $students->orWhere('students.last_name', 'LIKE',"%{$search}%");
                        $students =  $students->orWhere('students.email', 'LIKE',"%{$search}%");
                        $students =  $students->orWhere('students.phone_number', 'LIKE',"%{$search}%");
                        $students =  $students->orWhere('ud.university_name', 'LIKE',"%{$search}%");
                        $students =  $students->orWhere('ud.application_id', 'LIKE',"%{$search}%");
                        $students =  $students->orWhere('ud.application_date', 'LIKE',"%{$search}%");
                        $students =  $students->orWhere('ud.action_date', 'LIKE',"%{$search}%");
                        $totalFiltered = $students->count();
                    }

                if($order != "id"){
                    
                    $students = $students->orderBy($order,$dir);
                }
                else{
                    $students = $students->orderBy(DB::raw('(ud.action_date IS NULL), ud.action_date'),'ASC');
                }

                $students = $students->offset($start);
                $students = $students->limit($limit);

                $students = $students->get();
       
    
        $data = array();
        $confirm = "'Are Sure to Delete?'";
        if(!empty($students))
        {
            foreach ($students as $student_key => $student)
            {
                $edit = url('/')."/admin/students/".$student->id."/edit/";
                $invoice = url('/')."/admin/invoice/".$student->id;
                $delete = route('students.destroy', $student->id);
                $chat = url('/')."/admin/query/reply/".$student->id;

                $university_names = explode(",",$student->university_names); 
                $action_dates = explode(",",$student->action_dates); 
                $application_dates = explode(",",$student->application_dates); 
                $application_ids = explode(",",$student->application);

                $action = '<form method="post" action="'.$delete.'" enctype="multipart/form-data"> 

                                <a href="'.$chat.'" target="_new" class="btn btn-primary btn-sm"><i class="fa fa-comments"></i></a>

                                <a href="'.$invoice.'" class="btn btn-warning btn-sm"><i class="fa fa-list"></i></a>

                                <a href="'.$edit.'" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                 '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('.$confirm.')"><i class="fa fa-trash"></i></button>
                            </form>';

                $extra =  "";
                if($student->university_names){

                        $university_names = explode(",",$student->university_names); 
                        $action_dates = explode(",",$student->action_dates); 
                        $application_dates = explode(",",$student->application_dates); 
                        $application_ids = explode(",",$student->application_ids); 
               

                    $extra = '<div class="all_unversity" style="display: none" >
                                <div class="row">
                                    <div class="col-2"><b>Application Date</b></div>
                                    <div class="col-4"><b>University Details</b></div>
                                    <div class="col-3"><b>Application Id</b></div>
                                    <div class="col-3"><b>Action Date</b></div>
                                </div>
                         <hr>';
                    foreach($university_names as  $key => $name){
                        $extra .= '<div class="row">
                        <div class="col-2">'.$application_dates[$key].'</div>
                        <div class="col-4">'.$name.'</div>
                        <div class="col-3">'.$application_ids[$key].'</div>
                        <div class="col-3">'.$action_dates[$key].'</div></div>';
                   }
                    $extra .='</div>';
                }

                $updated_at =  $student->updated_at;
                $university = "";
                if($student->university_names) $university ='<a href="javascript:void(0)" class="expand_data"><i class="fa fa-caret-right"></i></a>' ;
                $nestedData['id'] = ($start ) + ($student_key + 1);
                $nestedData['university'] = $university;
                $nestedData['student_code'] = $student->student_code." (".$student->university_count.")";
                $nestedData['first_name'] = $student->first_name." ".$student->last_name ;
                $nestedData['phone_number'] = $student->phone_number;
                $nestedData['email'] = $student->email;
                $nestedData['action_date'] = $student->action_date;
                $nestedData['updated_date'] = date("d-m-Y",strtotime($updated_at));
                $nestedData['action'] = $action.$extra;
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data);

    }


    public function create() {
        $title = "Students";
        $document_types = DocumentType::get();
        return view('admin.student.create', compact('title', 'document_types'));
    }

    public function store(Request $request) {
         // return $request;
        // dd($request);
        $validatedData = $request->validate(['email' => 'required']);
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
        if($request->send_mail){
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
        }
        return redirect()->route('students.edit', [$student->id])
            ->with('message', 'Successfully Saved.');
      
        // $files = @$request->file('document');
        
        // if($files) {
        //     foreach($files as $key => $file) {
        //     $data_docuemnt = array();

        //    // $doc_id = $request->doc_id[$key];
        //     $file = @$request->file('document') [$key];
        //     $document_type = @$request->document_type[$key];
            
        //         $name = "document-" . time() . rand(1000, 200000);
        //         $file->move(public_path() . '/documents/', $name);
        //         $data_docuemnt['document'] = $name;
        //         $data_docuemnt['document_name'] = $file->getClientOriginalName();
            
        //     $data_docuemnt['document_type'] = $document_type;
        //     $data_docuemnt['student_id'] =  $student->id;

        //     }

        //     Document::create($data_docuemnt);
        //     }
        

        // foreach ($request->application_date as $key => $value) {
        //     $univdata = array();
        //     $univdata['student_id'] = $student->id;
        //     $univdata['application_date'] = $value;
        //     $univdata['university_name'] = $request->university_name[$key];
        //     $univdata['application_id'] = $request->application_id[$key];
        //     $univdata['major'] = $request->major[$key];
        //     $univdata['intake'] = $request->intake[$key];
        //     $univdata['action_needed'] = $request->action_needed[$key];
        //     $univdata['comments'] = $request->comments[$key];
        //     $univdata['action_date'] = $request->action_date[$key];

        //     $univdata['login_id'] = $request->login_id[$key];
        //     $univdata['login_password'] = $request->login_password[$key];
        //     $file = @$request->offer_letter[$key];
        //     if ($file) {
        //         $name = "document-" . time() . rand(1000, 200000);
        //         $file->move(public_path() . '/documents/', $name);
        //         $univdata['offer_letter'] = $name;
        //         $univdata['offer_letter_name'] = $file->getClientOriginalName();
        //     }
        //     University::create($univdata);
        // }
       
    }

    public function edit(Student $student) {
        $title = "Students";
        $id = $student->id;
        $document_types = DocumentType::get();
        $documents = Document::where('student_id', $id)->get();
        $univdatas = University::where('student_id', $id)->get();
        if($student->admin_status ==0){
            $data = array('admin_status' => 1,'timestamps' => false);
            $student->update($data);
        }
        return view('admin.student.edit', compact('title', 'student', 'documents', 'univdatas', 'document_types'));
    }

    public function update(Request $request, Student $student) {
        $data = $request->all();
        //echo $student->id;
        $data['updated_at'] =  date("Y-m-d h:i:sa");
        $student->update($data);

   
         // return $data;

        // foreach ($data['doc_id'] as $key => $value) {
        //     $data_docuemnt = array();
        //     $file = @$request->file('document') [$key];
        //     $document_type = @$request->document_type[$key];
        //     if (@$file) {
        //         $name = "document-" . time() . rand(1000, 200000);
        //         $file->move(public_path() . '/documents/', $name);
        //         $data_docuemnt['document'] = $name;
        //         $data_docuemnt['document_name'] = $file->getClientOriginalName();
        //     }
        //     $data_docuemnt['document_type'] = $document_type;
        //     $document = Document::find($value);
        //     $document->update($data_docuemnt);
        // }
           //pr($request->document_status);
      
            if($request->document_type) {

                foreach ($request->document_type as $key => $value) {
                
                    $doc_id = $request->doc_id[$key];
                    $document_type = @$request->document_type[$key];
                    $document_status = @$request->document_status[$key];
                    $files = @$request->file('document');
                    
                    $data_docuemnt = array();

                     $file = @$request->file('document')[$key];
                
                    if($file){
                        $name = "document-" . time() . rand(1000, 200000);
                        $file->move(public_path() . '/documents/', $name);
                        $data_docuemnt['document'] = $name;
                        $data_docuemnt['document_name'] = $file->getClientOriginalName();
                    }
                        
                    $data_docuemnt['document_type'] = $document_type;
                    $data_docuemnt['student_id'] = $student->id;
                    $data_docuemnt['document_status'] =  $document_status;

              
                    // pr($data_docuemnt);
                    // echo $doc_id."-----";
             
                if($doc_id) {
                    Document::where('id',$doc_id )->update($data_docuemnt);
                    
                }else{
                    Document::create($data_docuemnt);
                }
            }

        }
         
        if(@$request->application_date){
            foreach ($request->application_date as $key => $value) {
                $univdata = array();
                $univdata['student_id'] = $student->id;
                $unversity_id = @$request->univ_id[$key];
                $univdata['application_date'] = $value;
                $univdata['university_name'] = $request->university_name[$key];
                $univdata['application_id'] = $request->application_id[$key];
                $univdata['major'] = $request->major[$key];
                $univdata['intake'] = $request->intake[$key];
                $univdata['status'] = $request->status[$key];
                $univdata['action_needed'] = $request->action_needed[$key];
                $univdata['comments'] = $request->comments[$key];
                $univdata['action_date'] = $request->action_date[$key];

                $univdata['login_id'] = $request->login_id[$key];
                $univdata['login_password'] = $request->login_password[$key];
                
                $file = @$request->offer_letter[$key];
                if ($file) {
                    $name = "document-" . time() . rand(1000, 200000);
                    $file->move(public_path() . '/documents/', $name);
                    $univdata['offer_letter'] = $name;
                    $univdata['offer_letter_name'] = $file->getClientOriginalName();
                }

                if ($unversity_id) {
                    University::where('id', $unversity_id)->update($univdata);
                }
                else {
                    University::create($univdata);
                }
            }
        }
        $data = $request->all();
        $student->update($data);


    if(@$request->billing_date){
          $invoice = new Invoice;
          $student_id = $student->id;
          $invoice->invoice_number = $request->invoice_number;
          $invoice->student_id     = $student_id;
          $invoice->billing_date   = $request->billing_date;
          $invoice->billing_name   = $student->first_name.' '.$student->last_name;
          $invoice->billing_email  = $student->email;
          $invoice->billing_phone  = $student->phone_number;
          $invoice->sub_total      = $request->sub_total;
          $invoice->discount       = $request->discount;
          $invoice->total_amount   = $request->total_amount;
          $invoice->save();

          $invoice_number = "00-" . str_pad($invoice->id, 6, "0", STR_PAD_LEFT);
          $invoice_file_name = "invoice".$invoice->id."-".time().rand(0,10000000).".pdf";
          $invoice_data = array('invoice_number'=> $invoice_number,'invoice_file_name'=>$invoice_file_name);
          Invoice::where('id', $invoice->id)->update($invoice_data);
          foreach (@$request->application_name as $key => $value) {
              $inv_extra = new InvoiceExtras;
              $inv_extra->invoice_id       = $invoice->id;
              $inv_extra->application_name = $request->application_name[$key];
              $inv_extra->application_fees = $request->application_fees[$key];
              $inv_extra->service_fees     = $request->service_fees[$key];
              $inv_extra->amount     = $request->amount[$key];
              $inv_extra->save(); 
          }
           //new Invoice;send_invoice_mail()

            $controller = new InvoiceController;
            $controller->create_pdf($invoice->id);

            if(@$request->send_invoice == 1){
                $controller->mail($invoice->id);
            }
        }
       
      //$this->create_pdf($invoice->id);


        // Email Send After Document Updated
        $email = $request->email;
        //echo ($request->sent_mail);die;
        if ($request->sent_mail == 1) {
            $student = Student::where('email', $email)->first();
            if ($student) {
                $setting = Setting::first();
                $subject = $setting->company_name." - ".$request->updated_details;
                $student->updated_details = $request->updated_details;
                $html = view('student_details_updated_mail', compact('setting', 'student'))->render();
                //echo $html; die;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <' . $setting->company_email . '>' . "\r\n";
                mail($email, $subject, $html, $headers);
            }
        }
        return redirect('admin/students/'.$student->id."/edit")->with('message', 'Successfully Updated.');
    }

    public function show($student) {
        $title = "Students";
        $students = Student::select('students.*', 'university_details.university_name as univ_name')->leftJoin('university_details', 'university_details.student_id', 'students.id')
            ->where('id', $student)->orderBy('students.id', 'desc')
            ->get();
        return $students;
        return view('admin.student.show', compact('title', 'students'));
    }

    public function destroy($id) {

        University::where("student_id",$id)->delete();
        Document::where("student_id",$id)->delete();

        $student = Student::find($id);
        $student->delete();
        return redirect()->route('students.index')->with('message', 'Successfully Deleted.');
    }

    public function delete_university($id) {
        $university = University::find($id);
        $university->delete();
        // return redirect()->route('students.index')->with('message', 'Successfully Deleted.');
        
    }

    public function add_docs($id) {
        $title = "Student Documents";
        $students = Student::whereId($id)->first();
        return view('admin.student.add_docs', compact('title', 'students'));
    }

    public function store_docs(Request $request) {
        $data = $request->all();
        $data['student_id'] = $request->id;
        $file = $request->file('document');
        $name = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path() . '/documents/', $name);
        $data['document'] = $name;
        Document::create($data);
        return redirect()->route('students.index')
            ->with('message', 'Successfully Saved.');
    }


    public function university($id) {
        $university =  University::where('student_id', $id)->orderBy('action_date','asc')->get();
        $data = "";
        if($university){
            $data = "<tr><th colspan='3'>Action Date</th><th colspan='5'>University Name</th></tr>";
            foreach ($university as $key => $value) {
                $data .= "<tr><td colspan='3'>".$value->action_date."</td><td colspan='5'>". $value->university_name."</td></tr>";
            }
        }
        echo $data;
    }
}