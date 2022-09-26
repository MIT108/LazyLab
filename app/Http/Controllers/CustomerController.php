<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    //

    public function registerApi(Request $request)
    {
        $fields = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required',
            'school' => 'required',
            'password' => 'required|string',
            'dob' => 'required',
            'classroom_id' => 'required',
            'customer_type_id' => 'required'
        ]);

        $response = [];
        $code = 0;

        if (Classroom::find($fields['classroom_id'])) {
            if (CustomerType::find($fields['customer_type_id'])) {


                if ($this->checkPhone($fields['phone'])) {
                    $hashed = Hash::make($fields['password']);
                    if (Hash::needsRehash($hashed)) {
                        $hashed = Hash::make($fields['password']);
                    }

                    $fields['password'] = $hashed;

                    try {
                        $customer = Customer::create($fields);

                        $response = [
                            'data' => $customer,
                            'message' => 'Customer registration successful'
                        ];

                        $code = 200;
                    } catch (\Throwable $th) {

                        $response = [
                            'error' => $th->getMessage(),
                            'message' => 'Error while creating customer account'
                        ];

                        $code = 500;
                    }
                } else {

                    $response = [
                        'message' => 'This email address is already registered'
                    ];

                    $code = 422;
                }
            } else {
                $response = [
                    'message' => 'Invalid customer type'
                ];

                $code = 422;
            }
        } else {
            $response = [
                'message' => 'Invalid classroom'
            ];

            $code = 422;
        }

        return response($response, $code);
    }


    public function loginApi(Request $request)
    {
        $fields = $request->validate([
            'phone' => 'required',
            'password' => 'required|string'
        ]);

        $response = [];
        $code = 0;


        try {
            //check phone
            $customer = Customer::where('phone', $fields['phone'])->first();

            //check password
            if (!$customer || !Hash::check($fields['password'], $customer->password)) {
                $response = [
                    'message' => 'Bad credentials'
                ];
                $code = 422;
            } else {

                if ($customer->status == "inactive") {
                    $response = [
                        'message' => 'Account is suspended'
                    ];
                    $code = 422;
                } else {

                    $token = $customer->createToken('authenticationToken')->plainTextToken;

                    $response = [
                        'data' => $customer,
                        'token' => $token,
                        'message' => 'login successful'
                    ];

                    $code = 200;
                }
            }
        } catch (\Throwable $th) {
            $response = [
                'error' => $th->getMessage(),
                'message' => 'Internal server error'
            ];
            $code = 500;
        }


        return response($response, $code);
    }


    public function logoutApi()
    {
        $response = [];
        $code = 0;

        try {
            //code...
            auth()->user()->tokens()->delete();
            $response = [
                'message' => 'logout successful'
            ];
            $code = 200;
        } catch (\Throwable $th) {
            //throw $th;
            $response = [
                'error' => $th->getMessage(),
                'message' => 'logout error'
            ];
            $code = 500;
        }

        return response($response, $code);
    }


    public function changePassword(Request $request)
    {
        $fields = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string'
        ]);

        $user_id =  auth()->user()["id"];
        $fields += ['user_id' => $user_id];

        $user = Customer::find($fields['user_id']);

        $response = [];

        if (Hash::check($fields['old_password'], $user->password)) {
            try {
                $user->password = bcrypt($fields['new_password']);
                $user->save();

                $response = [
                    'data' => $user,
                    'message' => 'Password changed successfully'
                ];
            } catch (\Throwable $th) {
                $response = [
                    'error' => $th->getMessage,
                    'message' => 'could not change password'
                ];
            }
        } else {
            $response = [
                'error' => 'the old password is invalid',
                'message' => 'the old password is invalid'
            ];
        }

        return response($response, 200);
    }



    public function checkPhone($phone)
    {
        if (Customer::where('phone', $phone)->count() == 0) {
            return true;
        } else {
            return false;
        }
    }
}
