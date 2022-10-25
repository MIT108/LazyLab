<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    //

    public function createLesson(Request $request){

        $fields = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'subject_id' => 'required',
        ]);


        if ($this->checkName($fields['name'], $fields['subject_id'])) {
            try {
                try {
                    Lesson::create($fields);
                    return redirect()->back()->with('success', 'lesson created successfully');
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

    public function checkName($name, $subject_id)
    {
        if (Lesson::where('name', '=', $name)->where('subject_id', '=', $subject_id)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteLesson($id)
    {
        try {
            //code...
            $lesson = Lesson::find($id);
            if ($lesson) {
                Lesson::where('id', $id)->delete();
                return redirect()->back()->with('success', 'lesson deleted successful');
            } else {
                return redirect()->back()->with('error', 'this lesson does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function viewLesson($id)
    {
        $Lesson = Lesson::with('lesson_detail')->find($id);
        // dd($classroom);
        if ($Lesson) {
            return view('pages.lesson.view-lesson')
            ->with('lesson', $Lesson);
        } else {
            return redirect()->route('dashboard')->with('error', 'this lesson does not exist');
        }
    }
}