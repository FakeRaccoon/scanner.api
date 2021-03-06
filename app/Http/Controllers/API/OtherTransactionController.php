<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OtherTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OtherTransactionController extends Controller
{
    public function createTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'form_id'       => 'required',
            'name'          => 'required',
            'selected'      => 'required',
            'selected2'     => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {
            $query = OtherTransaction::create([
                'form_id'   => $request->form_id,
                'name'      => $request->name,
                'selected'  => $request->selected,
                'selected2' => $request->selected2,
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

    public function updateTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'            => 'required',
            'selected'      => 'required',
            'selected2'     => 'required',
            'type'          => 'nullable',
        ]);

        if ($validator->fails()) {
            $response = [
                'status'  => 400,
                'message' => 'Validasi!',
                'result'  => $validator->errors()
            ];

            return response()->json($response, 400);
        } else {

            $query = OtherTransaction::where('id', $request->id)->update([
                'selected'  => $request->selected,
                'selected2' => $request->selected2,
                'type'      => $request->type,
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

    public function deleteTransaction(Request $request)
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

            $query = OtherTransaction::where('id', $request->id)->delete();

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
