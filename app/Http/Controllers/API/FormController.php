<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function getData()
    {
        $data = Form::all();

        $result = [];
        if ($data) {
            if ($data->count() > 0) {
                foreach ($data as $d) {
                    $result[] = [
                        'id'                => $d->id,
                        'status'            => $d->status,
                        'task'              => $d->task,
                        'other_task'        => $d->other_task,
                        'tax'               => $d->tax,
                        'billing'           => $d->billing,
                        'from_user'         => $d->fromUser,
                        'to_user'           => $d->toUser,
                        'request_date'      => $d->request_date,
                        'pick_up_date'      => $d->pick_up_date,
                        'received_date'     => $d->received_date,
                        'transactions'      => $d->transactions,
                        'other_transactions' => $d->otherTransactions,
                        'created_at'        => date('Y-m-d H:i:s', strtotime($d->created_at)),
                        'updated_at'        => date('Y-m-d H:i:s', strtotime($d->updated_at))
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
            }
        } else {
            $response = [
                'status'  => 500,
                'message' => 'Server error!'
            ];
        }

        return response()->json($response);
    }


    public function getDataStatus(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'status'       => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {

            $data = Form::where('status', $request->status)->orderByDesc('received_date')->get();

            $result = [];
            if ($data) {
                if ($data->count() > 0) {
                    foreach ($data as $d) {
                        $result[] = [
                            'id'                => $d->id,
                            'status'            => $d->status,
                            'task'              => $d->task,
                            'other_task'        => $d->other_task,
                            'tax'               => $d->tax,
                            'billing'           => $d->billing,
                            'from_user'         => $d->fromUser,
                            'to_user'           => $d->toUser,
                            'request_date'      => $d->request_date,
                            'pick_up_date'      => $d->pick_up_date,
                            'received_date'     => $d->received_date,
                            'transactions'      => $d->transactions,
                            'other_transactions' => $d->otherTransactions,
                            'created_at'        => date('Y-m-d H:i:s', strtotime($d->created_at)),
                            'updated_at'        => date('Y-m-d H:i:s', strtotime($d->updated_at))
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
                }
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Server error!'
                ];
            }
        }


        return response()->json($response);
    }

    public function getData2Status(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'status1'       => 'required',
            'status2'       => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {

            $data = Form::whereBetween('status', [$request->status1, $request->status2])->get();

            $result = [];
            if ($data) {
                if ($data->count() > 0) {
                    foreach ($data as $d) {
                        $result[] = [
                            'id'                => $d->id,
                            'status'            => $d->status,
                            'task'              => $d->task,
                            'other_task'        => $d->other_task,
                            'tax'               => $d->tax,
                            'billing'           => $d->billing,
                            'from_user'         => $d->fromUser,
                            'to_user'           => $d->toUser,
                            'request_date'      => $d->request_date,
                            'pick_up_date'      => $d->pick_up_date,
                            'received_date'     => $d->received_date,
                            'transactions'      => $d->transactions,
                            'other_transactions' => $d->otherTransactions,
                            'created_at'        => date('Y-m-d H:i:s', strtotime($d->created_at)),
                            'updated_at'        => date('Y-m-d H:i:s', strtotime($d->updated_at))
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
                }
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Server error!'
                ];
            }
        }


        return response()->json($response);
    }

    public function getDataType(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type'       => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {

            $data = Form::all();

            $result = [];
            if ($data) {
                if ($data->count() > 0) {
                    foreach ($data as $d) {
                        $result[] = [
                            'id'                => $d->id,
                            'status'            => $d->status,
                            'task'              => $d->task,
                            'other_task'        => $d->other_task,
                            'tax'               => $d->tax,
                            'billing'           => $d->billing,
                            'from_user'         => $d->fromUser,
                            'to_user'           => $d->toUser,
                            'request_date'      => $d->request_date,
                            'pick_up_date'      => $d->pick_up_date,
                            'received_date'     => $d->received_date,
                            'transactions'      => $d->transactions,
                            'other_transactions' => $d->otherTransactions,
                            'created_at'        => date('Y-m-d H:i:s', strtotime($d->created_at)),
                            'updated_at'        => date('Y-m-d H:i:s', strtotime($d->updated_at))
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
                }
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Server error!'
                ];
            }
        }


        return response()->json($response);
    }

    public function getDataByDate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'from_date'        => 'required',
            'to_date'          => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {

            $data = Form::whereDate('request_date', '>=', $request->from_date)
                ->whereDate('request_date', '<=', $request->to_date)
                ->get();

            $result = [];
            if ($data) {
                if ($data->count() > 0) {
                    foreach ($data as $d) {
                        $result[] = [
                            'id'                => $d->id,
                            'status'            => $d->status,
                            'task'              => $d->task,
                            'other_task'        => $d->other_task,
                            'tax'               => $d->tax,
                            'billing'           => $d->billing,
                            'from_user'         => $d->fromUser,
                            'to_user'           => $d->toUser,
                            'request_date'      => $d->request_date,
                            'pick_up_date'      => $d->pick_up_date,
                            'received_date'     => $d->received_date,
                            'transactions'      => $d->transactions,
                            'other_transactions' => $d->otherTransactions,
                            'created_at'        => date('Y-m-d H:i:s', strtotime($d->created_at)),
                            'updated_at'        => date('Y-m-d H:i:s', strtotime($d->updated_at))
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
                }
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Server error!'
                ];
            }
        }


        return response()->json($response);
    }

    public function getDataId(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id'       => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {
            $data = Form::where('id', $request->id)->get();

            $result = [];
            if ($data) {
                if ($data->count() > 0) {
                    foreach ($data as $d) {
                        $result[] = [
                            'id'                => $d->id,
                            'status'            => $d->status,
                            'task'              => $d->task,
                            'other_task'        => $d->other_task,
                            'tax'               => $d->tax,
                            'billing'           => $d->billing,
                            'from_user'         => $d->fromUser,
                            'to_user'           => $d->toUser,
                            'request_date'      => $d->request_date,
                            'pick_up_date'      => $d->pick_up_date,
                            'received_date'     => $d->received_date,
                            'transactions'      => $d->transactions,
                            'other_transactions' => $d->otherTransactions,
                            'created_at'        => date('Y-m-d H:i:s', strtotime($d->created_at)),
                            'updated_at'        => date('Y-m-d H:i:s', strtotime($d->updated_at))
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
                }
            } else {
                $response = [
                    'status'  => 500,
                    'message' => 'Server error!'
                ];
            }
        }


        return response()->json($response);
    }

    public function createForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status'            => 'required',
            'task'              => 'nullable',
            'from_id'           => 'nullable',
            'to_id'             => 'nullable',
            'request_date'      => 'required',
            'other_task'        => 'nullable',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {
            $query = Form::create([
                'status'            => $request->status,
                'task'              => $request->task,
                'from_id'           => $request->from_id,
                'to_id'             => $request->to_id,
                'request_date'      => $request->request_date,
                'other_task'        => $request->other_task,
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

    public function updateForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'                => 'required',
            'task'              => 'nullable',
            'other_task'        => 'nullable',
            'status'            => 'required',
            'tax'               => 'nullable',
            'billing'           => 'nullable',
            'request_date'      => 'nullable',
            'pick_up_date'      => 'nullable',
            'received_date'     => 'nullable',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {
            $query = Form::where('id', $request->id)->update([
                'task'          => $request->task,
                'other_task'    => $request->other_task,
                'status'        => $request->status,
                'tax'           => $request->tax,
                'billing'       => $request->billing,
                'request_date'  => $request->request_date,
                'pick_up_date'  => $request->pick_up_date,
                'received_date' => $request->received_date,
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

    public function deleteForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'            => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {
            $query = Form::where('id', $request->id)->delete();

            if ($query) {
                $response = [
                    'status'  => 200,
                    'message' => 'Data berhasil dihapus!',
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
}
