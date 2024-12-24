<?php

namespace App\Http\Controllers\Api\Auth;

use App\ApiResponse\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PatientResource;

class AuthController extends Controller
{
        public function register(Request $request)
        {
        
                if (User::where('email', $request['email'])->exists()) {
                        return Response::SendResponse(
                                400,
                                'Email already exists',
                                null
                        );
                }         
                else{

                        $validatedData = $request->validate([
                        'name' => 'required|max:55',
                        'email' => 'email|required|unique:users',
                        'password' => 'required',
                        'adress' => 'required',
                        'gender' => 'required|in:male,female',
                        'date_of_birth' => 'required|date_format:Y-m-d',
                ]);


                $validatedData['password'] = bcrypt($request->password);
             

                if ($request->route()->getName() == 'patients.register') {

                      
                       
                                $user = User::create(
                                        [
                                                'name' => $validatedData['name'],
                                                'email' => $validatedData['email'],
                                                'password' => $validatedData['password'],
                                                'type' => 'patient',
                                        ]
                                );
                                $countries = $validatedData['adress'];

                                $user = Patient::create(
                                        [
                                       
                                                'user_id' => $user->id,
                                                'gender' => $validatedData['gender'],
                                                'date_of_birth' => $validatedData['date_of_birth'],
                                        ]

                                );
                                $user=Patient::create([
                                        
                                        'adress'=>'s'
                                        
                                ]);
                                
                                $token = $user->createToken('PatientToken')->plainTextToken;
                                return response()->json([
                                        'message' => 'User created successfully',
                                        'access_token' => $token,
                                        'token_type' => 'Bearer'
                                ]);
                        }
                }
        }
        


        public function login(Request $request)
        {



                $validatedData = $request->validate([
                        'email' => 'email|required',
                        'password' => 'required',
                ]);

                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        $user = Auth::user();
                        $token = $user->createToken('authToken')->plainTextToken;
                        $data = [
                                'Patient' => [$user, $user->patient],
                                'access_token' => $token,
                                'token_type' => 'Bearer'
                        ];




                        return Response::SendResponse(
                                200,
                                'User logged in successfully',
                                new PatientResource($user)
                                /*   [
'Patient_id' => $user->id,
                                          'Patient_name' => $user->name,
                                          'Patient_email' => $user->email,
                                          'Patient_type' => $user->type,

                                          'Patient_info' => $user->patient,
                                          'access_token' => $token,
                                          'token_type' => 'Bearer' */
                        );

                } 


          


        }
}

