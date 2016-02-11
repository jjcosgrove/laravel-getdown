<?php

namespace GetDown\Http\Controllers;

use GetDown\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

use Auth;
use File;
use Session;

use GetDown\Document as Document;
use GetDown\Template as Template;

class AppController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function documents()
    {
        $user = Auth::user();

        //grab all documents and templates for this user
        $documents = Document::where('user_id','=', $user->id)
            ->orderBy('created_at','DESC')
            ->get();
        $templates = Template::where('user_id','=', $user->id)
            ->orderBy('title','ASC')
            ->get();

        //render everything on the main documents listing
        return view('documents')->with([
            'documents' => $documents,
            'templates' => $templates
        ]);
    }

    public function createNewDocument()
    {   
        //show the user the create document page, with any template - if found
        return view('create-new-document')->with(
            'template', Session::pull('template', null)
        );
    }

    public function createNewDocumentFromTemplate($id)
    {
        //grab the template based on the $id parameter
        $template = Template::where('id','=', $id)
            ->get()
            ->first();

        //store it for the next request/after redirect
        Session::put('template', $template);

        //now go ahead and redirect to the usual create-new-document
        return Redirect::route('create-new-document');
    }


    public function viewDocument($id)
    {
        //grab the document that the user wishes to see
        $document = Document::where('id','=',$id)
            ->get()
            ->first();

        //pass it back to the view-document view
        return view('view-document')
            ->with('document', $document);
    }

    public function editDocument($id)
    {
        //grab the document that the user wishes to edit
        $document = Document::where('id','=',$id)->get()->first();

        //pass it back to the edit-document view
        return view('edit-document')
            ->with('document', $document);
    }

    public function updateDocument(Request $request, $id)
    {
        //find the original document with the id: $id and update it
        $document = Document::where('id','=', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content
        ]);

        //store a message for the view
        Session::flash('message', 'Document updated!');

        //redirect
        return redirect('documents');
    }

    public function deleteDocument($id)
    {
        //find the document with the id: $id that the user wishes to delete
        $document = Document::where('id','=',$id)->get()->first();

        //delete it
        $document->delete();

        //store a message for the view
        Session::flash('message', 'Document deleted!');

        //redirect
        return redirect('documents');
    }

    public function saveDocument(Request $request)
    {
        //new document
        $document = new Document;
        
        //set the fields
        $document->title = $request->title;
        $document->description = $request->description;
        $document->content = $request->content;

        //associate to the current user
        $document->user()->associate(Auth::user()->id);

        //save it
        $document->save();

        //store a message for the view
        Session::flash('message', 'Document saved!'); 

        //redirect
        return redirect('documents');
    }

    public function templates()
    {
        $user = Auth::user();

        //grab all of the templates for the current user
        $templates = Template::where('user_id','=',$user->id)
            ->orderBy('created_at','DESC')
            ->get();

        //return to the templates view with the list of templates
        return view('templates')->with([
            'templates' => $templates
        ]);
    }

    public function createNewTemplate()
    {
        //return view
        return view('create-new-template');
    }

    public function viewTemplate($id)
    {
        //find the template with the id: $id that the user wishes to view
        $template = Template::where('id','=',$id)
            ->get()
            ->first();

        //return to the view-template view with the template
        return view('view-template')
            ->with('template', $template);
    }

    public function editTemplate($id)
    {
        //find the template with the id: $id that the user wishes to edit
        $template = Template::where('id','=',$id)->get()->first();

        //retirn to the edit-template view with the template
        return view('edit-template')
            ->with('template', $template);
    }

    public function updateTemplate(Request $request, $id)
    {
        //find the original document with the id: $id and update it
        $template = Template::where('id','=',$id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content
        ]);

        //store message for the view
        Session::flash('message', 'Template updated!');
        
        //redirect
        return redirect('templates');
    }

    public function deleteTemplate($id)
    {
        //find the document with the id: $id that the user wishes to delete
        $template = Template::where('id','=', $id)
            ->get()
            ->first();

        //delete it
        $template->delete();

        //store a message for the view
        Session::flash('message', 'Template deleted!');

        //redirect
        return redirect('templates');
    }

    public function saveTemplate(Request $request)
    {
        //create a new template
        $template = new Template;
        
        //set the fields
        $template->title = $request->title;
        $template->description = $request->description;
        $template->content = $request->content;

        //associate it with the current user
        $template->user()->associate(Auth::user()->id);

        //save it
        $template->save();

        //set a message for the view
        Session::flash('message', 'Template saved!'); 

        //redirect
        return redirect('templates')->with('message','Template saved!');
    }

    public function getPreferences()
    {
        //grab the current user
        $user = Auth::user();

        //search for bootswatch themes
        $bootswatch_themes = File::directories('assets/vendor/bootswatch');

        //grab the theme names and sort
        $themes = collect($bootswatch_themes)
            ->map(function($path){
                return basename($path);
            })->sort();

        //render preferences page with the current user, themes and any messages
        return view('preferences')
            ->with([
                'user' => $user,
                'themes' => $themes,
                'message' => Session::get('message')
            ]);
    }

    public function updatePreferences(Request $request)
    {
        $user = Auth::user();

        //update the user preferences (theme changed?)
        $user->preferences->theme = $request->theme;

        //save preferences/user
        $user->preferences->save();
        $user->save();

        //store a message for the view
        Session::flash('message', 'Preferences updated!');

        //redirect
        return redirect('documents');
    }
}
