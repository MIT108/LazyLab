<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //
    public function createSubject(Request $request){
        $fields = $request->validate([
            'image' => 'required|file',
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        dd($fields);

    }

    public function deleteSubject($id){

    }

    public function viewSubject($id){
        $classroom = Subject::with('classroom')->find($id);
        // dd($classroom);
        if ($classroom) {
            return view('pages.subject.view-subject')
                ->with('classroom', $classroom);
        } else {
            return redirect()->route('dashboard')->with('error', 'this classroom does not exist');
        }
    }
}
