<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Illuminate\Http\Request;

class ObjectiveController extends Controller
{
    //

    public function listObjectives()
    {
        $objectives = Objective::get();
        return view('pages/objective/objective-management')->with('objectives', $objectives);
    }

    public function createObjective(Request $request)
    {
        $fields = $request->validate([
            "name" => 'required',
        ]);

            if ($this->checkName($fields['name'])) {
                $fields += [
                    "role_id" => 2
                ];
                try {
                    //code...
                    Objective::create($fields);
                    return redirect()->back()->with('success', 'objective created successfully');
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->with('error', 'Server Error');
                }
            } else {
                return redirect()->back()->with('error', 'This name already exist');
            }
    }

    public function checkName($name)
    {
        if (Objective::where('name', '=', $name)->count() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteObjective($id)
    {
        try {
            //code...
            $user = Objective::find($id);
            if ($user) {
                Objective::where('id', $id)->delete();
                return redirect()->back()->with('success', 'Objective deleted successful');
            } else {
                return redirect()->back()->with('error', 'this objective does not exist');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

}
