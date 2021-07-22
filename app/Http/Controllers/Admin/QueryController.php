<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Query;
use App\Models\Student;
use Hash;
use DB;
use Response;

class QueryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Query";
  
    // $querys = Query::select('queries.*', 'students.student_code', 'students.first_name')
           
    //         ->leftJoin('students', 'students.id', 'queries.user_id')
    //         ->groupBy('queries.user_id')
    //         ->orderBy('queries.id', 'desc')
    //         ->get();

          $querys = Query::select('q.*', 'students.student_code', 'students.first_name')
            ->from(DB::raw('(select * from queries  order by id desc  LIMIT 18446744073709551615 )as  q ') )
            ->join('students', 'students.id', '=', 'q.user_id')
            ->groupBy('q.user_id')
            ->orderBy('q.id','desc')
            ->get();

            
  // return $querys;
        return view('admin.query.index', compact('title', 'querys'));
    }

    public function show($id)
    {
     
    }

    public function reply(Request $request, $id)
    {
       
        if($request->isMethod('post'))
        {
            $datas = $request->all();
            if($request->message) {
                $datas['admin_notification'] = 1;
                $datas['admin_read_status'] = 1;
                $student = Query::create($datas);
            }
          
            if($request->admin_read_status == 1) {
                $data = array(
                    'admin_read_status'   => 1
                );

                Query::where('user_id',$request->user_id)->where('admin_read_status',0)->update($data);
            }
            return redirect("admin/query/reply/".$id);
        }

        $title = "Query";


         $querys = Query::select('queries.*', 'students.student_code', 'students.first_name','users.name as admin_name')
                    ->leftjoin('students', 'students.id', '=', 'queries.user_id')
                    ->leftjoin('users', 'users.id', '=', 'queries.admin_id')
                    ->orderBy('id','asc')
                    ->where('user_id', $id)->get();


        $student = Student::where('id', $id)->first();

        $data = array('admin_read_status' => 1);
        Query::where('admin_read_status', 0)->where('user_id', $id)->update($data);

        $data2 = array('admin_notification' => 1);
        Query::where('admin_notification', 0)->where('user_id', $id)->update($data2);

        //pr($querys); ; die;
        return view('admin.query.reply', compact('title', 'querys','student'));
    }

    public function status(Request $request, $id)
    {


    }

    public function notification(Request $request)
    {
         $querys = Query::select('q.*', 'students.student_code', 'students.first_name',DB::raw('count(q.user_id) as total_count'))
            ->from(DB::raw('(select * from queries  order by id desc  LIMIT 18446744073709551615 )as  q ') )
            ->join('students', 'students.id', '=', 'q.user_id')
            ->where('admin_notification', 0)
            ->groupBy('q.user_id')
            ->orderBy('q.id','desc')->get();
        $querys_count = count($querys);
        $querys_data = $querys;
        $data = array();
        $data['count'] = $querys_count;
        $data['data'] = array();
        foreach ($querys_data as $key => $value) {
           $data['data'][] = array(
                        'title'         => $value->first_name." (".$value->student_code.")",
                        'description'   => substr($value->message,0,100)."...",
                        'url'           => url('admin/query/reply/'.$value->user_id),
                        'id'            => $value->user_id
           ); 
        }

        return Response::json($data);
    }


    public function admin_notification($id)
    {
        $data = array(
            'admin_notification'    => 1
        );

        Query::where('user_id',$id)->update($data);
    }
}