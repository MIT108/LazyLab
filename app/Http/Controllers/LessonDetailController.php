<?php

namespace App\Http\Controllers;

use App\Models\LessonDetail;
use Illuminate\Http\Request;

class LessonDetailController extends Controller
{
    public function createLessonDetail(Request $request){

        $fields = $request->validate([
            'head' => 'required|string',
            'author' => 'required|string',
            'lesson_id' => 'required'
        ]);


        if ($this->checkName($fields['head'], $fields['lesson_id'])) {
            try {
                try {
                    LessonDetail::create($fields);
                    return redirect()->back()->with('success', 'lesson detail created successfully');
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

    public function checkName($head, $lesson_id)
    {
        if (LessonDetail::where('head', '=', $head)->where('lesson_id', '=', $lesson_id)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }
    public function viewLessonDetail($id)
    {
        $Lesson = LessonDetail::find($id);
        // dd($classroom);
        if ($Lesson) {
            return view('pages.lesson_detail.view-lesson_detail')
            ->with('lesson_detail', $Lesson);
        } else {
            return redirect()->route('dashboard')->with('error', 'this lesson does not exist');
        }
    }
    public function deleteLessonDetail($id)
    {
        try {
            //code...
            $lesson = LessonDetail::find($id);
            if ($lesson) {
                LessonDetail::where('id', $id)->delete();
                return redirect()->back()->with('success', 'lesson detail deleted successful');
            } else {
                return redirect()->back()->with('error', 'this lesson does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function editVideoLessonDetail(Request $request){

        $fields = $request->validate([
            'video' => 'required|string',
            'lesson_detail_id' => 'required'
        ]);
        try {
            $lesson = LessonDetail::find($fields['lesson_detail_id']);
            if ($lesson) {
                $lesson->video = $fields['video'];
                $lesson->save();
                return redirect()->back()->with('success', 'lesson detail updated successful');
            } else {
                return redirect()->back()->with('error', 'this lesson does not exist');
            }

        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }

    }


    public function editCourseLessonDetail(Request $request)
    {

        $fields = $request->validate([
            'course' => 'required|string',
            'lesson_detail_id' => 'required'
        ]);
        try {
            $lesson = LessonDetail::find($fields['lesson_detail_id']);
            if ($lesson) {
                $lesson->course = $fields['course'];
                $lesson->save();
                return redirect()->back()->with('success', 'lesson detail updated successful');
            } else {
                return redirect()->back()->with('error', 'this lesson does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }



    public function editDefinitionLessonDetail(Request $request)
    {

        $fields = $request->validate([
            'definition' => 'required|string',
            'lesson_detail_id' => 'required'
        ]);
        try {
            $lesson = LessonDetail::find($fields['lesson_detail_id']);
            if ($lesson) {
                $lesson->definition = $fields['definition'];
                $lesson->save();
                return redirect()->back()->with('success', 'lesson detail updated successful');
            } else {
                return redirect()->back()->with('error', 'this lesson does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

}
