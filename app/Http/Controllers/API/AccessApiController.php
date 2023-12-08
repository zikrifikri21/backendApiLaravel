<?php

namespace App\Http\Controllers\API;

use App\Helpers\TheResponse;
use App\Models\Super\Access;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class AccessApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data = Access::all();
            return TheResponse::success($data, 'Data Hak akses user', 200);
        } catch (\Exception $error) {
            return TheResponse::error([
                "message" => "Something went wrong",
                "error" => $error
            ], 'Autincate failed', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_role_id' => 'required',
                'menu_id'      => 'required',
            ]);

            $data = Access::create($request->all());
            return TheResponse::success($data, 'Berhasil Menambah akses', 200);
        } catch (\Exception $error) {
            if ($error instanceof ValidationException) {
                return TheResponse::error([
                    "message" => "Validation failed",
                    "errors" => $error->errors()
                ], 'Validation failed', 422);
            } else {
                return TheResponse::error([
                    "message" => "Something went wrong",
                    "error" => $error
                ], 'Autincate failed', 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'user_role_id' => 'required',
                'menu_id'      => 'required',
            ]);

            $data = Access::find($id);
            $data->update($request->all());

            return TheResponse::success($data, 'Berhasil Perbarui akses', 200);
        } catch (\Exception $error) {
            if ($error instanceof ValidationException) {
                return TheResponse::error([
                    "message" => "Validation failed",
                    "errors" => $error->errors()
                ], 'Validation failed', 422);
            } else {
                return TheResponse::error([
                    "message" => "Something went wrong",
                    "error" => $error
                ], 'Autincate failed', 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Access::find($id);
            $data->delete();

            return TheResponse::success($data, 'Berhasil Menghapus akses', 200);
        } catch (\Exception $error) {
            return TheResponse::error([
                "message" => "Something went wrong",
                "error" => $error
            ], 'Autincate failed', 500);
        }
    }
}
