<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Page;
use File;
use Session;
use Hash;
use Str;
class pageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Page::all();
        $title = "Page";
        return view('admin.page.index', compact('title','results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add page";
        return view('admin.page.create', compact('title'));
    }

    /**
     * Store a newly Saved resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        
        $this->validate($request, [
            'page_name'        => 'required',
            'page_description' => 'required',
        ]);
        $data = $request->all();
        // $data['page_slug'] = Str::slug($data['page_name'],"-");
        $data['page_slug'] = Str::slug($data['page_name'],"-");
    
        $page = new page;           
        $page->create($data);
        Session::flash('message', 'Successfully Saved.');
        return redirect('admin/page');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Page::find($id);
         $title = "Edit page";
        return view('admin/page.edit', compact('title','result', 'id'));
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

        
        $this->validate($request, [
            'page_name'        => 'required',
            'page_description' => 'required',
        ]);

        $data = $request->all();
        $page = Page::find($id);          
        $page->update($data);
        Session::flash('message', 'Successfully Saved.');
        return redirect('admin/page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Page::find($id)->delete();
        Session::flash('message', 'Successfully Deleted.');
        return redirect('admin/page');
    }
    public function status($id,$status)
        {   
            $page = Page::find($id);
            $page->page_status = $status;
            $page->save();

        }

}