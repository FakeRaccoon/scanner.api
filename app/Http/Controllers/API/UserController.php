<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function getDataId(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {

            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        }

        $data = User::where('id', $request->id)->get();

        if ($data) {
            $response = [
                'status'     => 200,
                'message'    => 'Data ditemukan!',
                'result'     => $data
            ];
        } else {
            $response = [
                'status'     => 404,
                'message'    => 'Data tidak ditemukan!',
                'result'     => $data
            ];
        }

        return response()->json($response);
    }

    public function getDataRole(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'role' => 'required',
        ]);

        if ($validator->fails()) {

            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        }

        $data = User::where('role', $request->role)->get();

        if ($data) {
            $response = [
                'status'     => 200,
                'message'    => 'Data ditemukan!',
                'result'     => $data
            ];
        } else {
            $response = [
                'status'     => 404,
                'message'    => 'Data tidak ditemukan!',
                'result'     => $data
            ];
        }

        return response()->json($response);
    }

    public function getData()
    {

        $data = User::all();

        $result = [];
        if ($data) {
            if ($data->count() > 0) {
                foreach ($data as $d) {
                    $result[] = [
                        'id'          => $d->id,
                        'username'    => $d->username,
                        'name' => $d->name,
                        'role' => $d->role,
                        'token' => $d->token,
                        'created_at'  => date('Y-m-d H:i:s', strtotime($d->created_at)),
                        'updated_at'  => date('Y-m-d H:i:s', strtotime($d->updated_at))
                    ];
                }
                $response = [
                    'status'     => 200,
                    'message'    => 'Data ditemukan!',
                    'total_data' => count($result),
                    'result'     => $result
                ];
            } else {
                $response = [
                    'status'     => 404,
                    'message'    => 'Data tidak ditemukan!',
                    'total_data' => count($result),
                    'result'     => $result
                ];

                return response()->json($response, 404);
            }
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Server error!'
            ];
        }

        return response()->json($response);
    }

    public function updateUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {

            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required',
                'role' => 'required',
                'token' => 'nullable'
            ]);

            if ($validator->fails()) {

                $response = [
                    'status'  => 400,
                    'message' => 'Validasi!',
                    'result'  => $validator->errors()
                ];

                return response()->json($response, 400);
            }
            $query = User::where('id', $request->id)->update([
                'name'  => $request->name,
                'username'      => $request->username,
                'role' => $request->role,
                'token' => $request->token,
            ]);

            if ($query) {
                $response = [
                    'status'  => 200,
                    'message' => 'Data berhasil diproses!',
                    'result'  => $request->all()
                ];
            } else {
                $response = [
                    'status'  => 400,
                    'message' => 'Data gagal diproses!',
                    'result'  => $request->all()
                ];

                return response()->json($response, 400);
            }
        }

        return response()->json($response);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'username' => 'required|min:3',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['username'] =  $user->username;

        return $this->sendResponse($success, 'User register successfully.');
    }


    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            $success['id'] = $user->id;
            $success['username'] =  $user->username;
            $success['name'] = $user->name;
            $success['role'] = $user->role;
            $success['token'] =  $user->createToken('MyApp')->accessToken;


            $response = [
                'status'    => 200,
                'message'   => "User login successfully",
                'result'    => $success,
            ];

            return response()->json($response);
        } else {
            $response = [
                'status'    => 400,
                'message'   => "User login failed",
            ];

            return response()->json($response, 400);
        }
    }
}
