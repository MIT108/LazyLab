<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //
    public function createSubject(Request $request){
        $fields = $request->validate([
            'image' => 'required|file',
            'name' => 'required|string',
            'description' => 'required|string',
            'classroom_id' => 'required',
        ]);


        if ($this->checkName($fields['name'], $fields['classroom_id'])) {
            try {
                //code...
                $imageFullName = $request->file('image')->getClientOriginalName();
                $fileName = strtotime(Carbon::now()) . $imageFullName;
                $fields['image'] = $fileName;

                try {

                    Subject::create($fields);

                    $request->file('image')->storeAs('public/subject', $fileName);

                    return redirect()->back()->with('success', 'subject created successfully');
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->with('error', $th->getMessage());
                }
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('error', $th->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'The name is already used');
        }
    }

    public function checkName($name, $classroom_id)
    {
        if (Subject::where('name', '=', $name)->where('classroom_id', '=', $classroom_id)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteSubject($id)
    {
        try {
            //code...
            $subject = Subject::find($id);
            if ($subject) {
                Subject::where('id', $id)->delete();
                return redirect()->back()->with('success', 'subject deleted successful');
            } else {
                return redirect()->back()->with('error', 'this subject does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    public function viewSubject($id){
        $subject = Subject::with('lesson')->find($id);
        // dd($classroom);
        if ($subject) {
            return view('pages.subject.view-subject')
                ->with('subject', $subject);
        } else {
            return redirect()->route('dashboard')->with('error', 'this subject does not exist');
        }
    }
}
