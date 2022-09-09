<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    //

    public function listClassrooms()
    {
        $classrooms = Classroom::whereIn('status', ['active', 'inactive'])->get();
        return view('pages/classroom/classroom-management')->with('classrooms', $classrooms);
    }

    public function deletedClassrooms()
    {

        $classrooms = Classroom::whereIn('status', ['deleted'])->get();
        return view('pages/classroom/deleted-classrooms')->with('classrooms', $classrooms);
    }

    public function createClassroom(Request $request)
    {
        // dd($request);
        $fields = $request->validate([
            "name" => 'required',
            "description" => 'required',
            'image' => 'required|file',
        ]);

        if ($this->checkName($fields['name'])) {
            try {
                //code...
                $imageFullName = $request->file('image')->getClientOriginalName();
                $fileName = strtotime(Carbon::now()) . $imageFullName;
                $fields['image'] = $fileName;

                try {

                    Classroom::create($fields);

                    $request->file('image')->storeAs('public/classroom', $fileName);

                return redirect()->back()->with('success', 'Classroom created successfully');
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->with('error', $th->getMessage());
                }
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('error', $th->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'The is already used');
        }
    }

    public function checkName($name)
    {
        if (Classroom::where('name', '=', $name)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }



    public function suspendClassroom($id)
    {
        try {
            //code...
            $classroom = Classroom::find($id);
            if ($classroom) {
                $classroom->status = 'inactive';
                $classroom->save();
                return redirect()->back()->with('success', 'classroom suspended successful');
            } else {
                return redirect()->back()->with('error', 'this classroom does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function activateClassroom($id)
    {
        try {
            //code...
            $classroom = Classroom::find($id);
            if ($classroom) {
                $classroom->status = 'active';
                $classroom->save();
                return redirect()->back()->with('success', 'classroom activated successful');
            } else {
                return redirect()->back()->with('error', 'this classroom does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function deleteClassroom($id)
    {
        try {
            //code...
            $classroom = Classroom::find($id);
            if ($classroom) {
                $classroom->status = 'deleted';
                $classroom->save();
                return redirect()->back()->with('success', 'classroom deleted successful');
            } else {
                return redirect()->back()->with('error', 'this classroom does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function viewClassroom($id)
    {
        $classroom = Classroom::with('role')->find($id);
        // dd($classroom);
        if ($classroom) {
            return view('laravel-examples/view-classroom')
                ->with('classroom', $classroom);
        } else {
            return redirect()->route('dashboard')->with('error', 'this classroom does not exist');
        }
    }
}
