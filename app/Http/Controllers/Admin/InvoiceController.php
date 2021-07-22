<?php


namespace App\Http\Controllers\Admin;

require_once "vendor/autoload.php";
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Setting;
use App\Models\Invoice;
use App\Models\InvoiceExtras;
use Hash;
use Session;
use Auth;
use PDF;

  Class InvoiceController extends Controller
  {
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($student_id) {

      $title = "Invoice Lists";
      $invoices = Invoice::select('invoice.*')
      ->where('student_id',$student_id)
      ->get();
      return view('admin.invoice.index', compact('title', 'invoices','student_id'));
    }

    public function create($student_id) {

      $title = "Invoice Create";
      $student = Student::where('id', $student_id)->first();
      $setting = Setting::first();
      return view('admin.invoice.create', compact('title', 'student', 'setting',));
    }

    public function create_pdf($invoice_id){
      $title = "";
      $data['invoice'] = $invoice = Invoice::where('id', $invoice_id)->first();

      $data['student'] = $student=  Student::where('id', $invoice->student_id)->first();

      $data['invoice_extras'] = $invoice_extras= InvoiceExtras::where('invoice_id', $invoice_id)->get();

      $data['setting'] =  $setting = Setting::first();

        $student_email = $student->email;
        $subjects = "Invoice - ".$invoice->invoice_number." From ".$setting->company_name;
        //pr($student);die;
        //echo $pdf = PDF::loadView('admin.invoice.invoice_mail',$data);
        $htmls = view('admin.invoice.invoice_mail', compact('title', 'invoice','invoice_extras', 'setting', 'student'))->render();
        // die;

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetTitle($invoice->invoice_number);
        $mpdf->WriteHTML($htmls);
        //$mpdf->Output();

        //ob_clean();
        $mpdf->Output('public/invoice/'.$invoice->invoice_file_name, 'F');
    }

    public function send_invoice_mail($invoice_id)
    {
      $this->mail($invoice_id);
      $data['student'] = $student=  Student::where('id', $invoice->student_id)->first();
      return redirect('admin/invoice/'.$student->id)->with('message', 'Invoice Mail has been sent successfully.');
    }

    public function mail($invoice_id){
      $data['invoice'] = $invoice = Invoice::where('id', $invoice_id)->first();
      $data['student'] = $student=  Student::where('id', $invoice->student_id)->first();
      $data['invoice_extras'] = $invoice_extras= InvoiceExtras::where('invoice_id', $invoice_id)->get();
      $data['setting'] =  $setting = Setting::first();
      $student_email = $student->email;
      $subjects = "Invoice - ".$invoice->invoice_number." From ".$setting->company_name;

      $htmls = view('admin.invoice.mail', compact('setting', 'student'))->render();
      //echo $htmls ; die;

      $filename = $invoice->invoice_file_name;
      $path = 'public/invoice';
      $file = $path . "/" . $filename;

      $mailto = 'mail@mail.com';
      $subject = 'Subject';
      $message = $htmls;

      $content = file_get_contents($file);
      $content = chunk_split(base64_encode($content));

      // a random hash will be necessary to send mixed content
      $separator = md5(time());

      // carriage return type (RFC)
      $eol = "\r\n";

      // main header (multipart mandatory)
      $headers = "From: ".$setting->company_name." <".$setting->company_email.">" . $eol;
      $headers .= "MIME-Version: 1.0" . $eol;
      $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
      $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
      $headers .= "This is a MIME encoded message." . $eol;

      // message
      $body = "--" . $separator . $eol;
      $body .= "Content-type:text/html;charset=UTF-8"  . $eol;
      $body .= "Content-Transfer-Encoding: 8bit" . $eol;
      $body .= $message . $eol;

      // attachment
      $body .= "--" . $separator . $eol;
      $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
      $body .= "Content-Transfer-Encoding: base64" . $eol;
      $body .= "Content-Disposition: attachment" . $eol;
      $body .= $content . $eol;
      $body .= "--" . $separator . "--";

      //SEND Mail
      if (mail($student_email, $subjects, $body, $headers)) {
          //echo "mail send ... OK"; // or use booleans here
      } else {
          //echo "mail send ... ERROR!";
          print_r( error_get_last() );
          die;
      }
      return true;
    }

    public function store(Request $request, $student_id) 
    {
     
      $title = "Student Invoice";
      $student = Student::where('id', $student_id)->first();

      $invoice = new Invoice;

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
      foreach ($request->application_name as $key => $value) {
      $inv_extra = new InvoiceExtras;
      $inv_extra->invoice_id       = $invoice->id;
      $inv_extra->application_name = $request->application_name[$key];
      $inv_extra->application_fees = $request->application_fees[$key];
      $inv_extra->service_fees     = $request->service_fees[$key];
      $inv_extra->amount     = $request->amount[$key];
      $inv_extra->save(); 
      }
      $this->create_pdf($invoice->id);

      return redirect('admin/invoice/'.$student_id)->with('message', 'Invoice Successfully Created.');
      }

    public function show($invoice_id)
    {

      $title = "Student Invoice";
      $invoice = Invoice::where('id', $invoice_id)->first();

      $student = Student::where('id', $invoice->student_id)->first();

      $invoice_extras = InvoiceExtras::where('invoice_id', $invoice_id)->get();
      $setting = Setting::first();

      return view('admin.invoice.show', compact('title', 'invoice','invoice_extras', 'setting', 'student'));
    }

    public function edit($invoice_id, $student_id)
    {
      
      $title = "Edit Invoice";

      $student = Student::where('id', $student_id)->first();
      $invoice = Invoice::where('id', $invoice_id)->where('student_id', $student_id)->first();
      $invoice_extras = InvoiceExtras::where('invoice_id', $invoice_id)->get();
      $setting = Setting::first();

      return view('admin.invoice.edit', compact('title', 'invoice','invoice_extras', 'setting', 'student'));
    }

    public function update(Request $request, $invoice_id, $student_id) 
    {

      $title = "Student Invoice";
      $student = Student::where('id', $student_id)->first();

      $invoice_data['invoice_number'] = $request->invoice_number;
      $invoice_data['student_id']     = $student_id;
      $invoice_data['billing_date']   = $request->billing_date;
      $invoice_data['billing_name']   = $student->first_name.' '.$student->last_name;
      $invoice_data['billing_email']  = $student->email;
      $invoice_data['billing_phone']  = $student->phone_number;
      $invoice_data['sub_total']      = $request->sub_total;
      $invoice_data['discount']       = $request->discount;
      $invoice_data['total_amount']   = $request->total_amount;
     
      $invoice = Invoice::where('id', $invoice_id)->update($invoice_data);
     
      foreach($request->application_name as $key => $value) {

      $inv_extra = array();

      $inv_etc_id = $request->invoice_id[$key];

      $inv_extra['invoice_id']       = $invoice_id;
      $inv_extra['application_name'] = $request->application_name[$key];
      $inv_extra['application_fees'] = $request->application_fees[$key];
      $inv_extra['service_fees']     = $request->service_fees[$key];
      $inv_extra['amount']           = $request->amount[$key];
      
        if($inv_etc_id) {
                InvoiceExtras::where('id', $inv_etc_id)->update($inv_extra);
            }
            else {
                InvoiceExtras::create($inv_extra);
            }
      }

      $this->create_pdf($invoice_id);
      return redirect('admin/invoice/'.$student_id)->with('message', 'Invoice Successfully Created.');
      }

    public function delete($invoice_id)
    {
        $invoice = Invoice::where('id', $invoice_id)->delete();
        $invoice_extras = InvoiceExtras::where('invoice_id', $invoice_id)->delete();
        return redirect('admin/invoice')->with('message', 'Successfully Deleted.');
    }



}

