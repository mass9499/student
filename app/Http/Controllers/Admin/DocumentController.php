<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Document;

use Illuminate\Http\Request;



class DocumentController extends Controller

{


    public function index()

    {

        $title = "Documents";

        $documents = Document::all();

        return view('admin.document.index', compact('title', 'documents'));        

    }

    public function create()

    {

        $title = "Documents";

        return view('admin.document.create', compact('title'));

    }


    public function store(Request $request)

    {


        redirect('documents.index');

    }



    public function show(Document $document)

    {

        //

    }

    public function edit(Document $document)

    {

        //

    }



    public function update(Request $request, Document $document)

    {

        //

    }




    public function destroy(Document $document)

    {

        //

    }

}

