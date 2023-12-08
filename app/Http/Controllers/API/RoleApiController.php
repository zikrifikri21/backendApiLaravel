<?php

namespace App\Http\Controllers\API;

use App\Helpers\TheResponse;
use Illuminate\Http\Request;
use App\Models\Super\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class RoleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = UserRole::all();
            return TheResponse::success($data, 'Data Role', 200);
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
                'nama' => 'required',
            ]);

            $data = UserRole::create($request->all());
            return TheResponse::success($data, 'Berhasil Menambah Role', 200);
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
        try {
            $data = UserRole::find($id);
            return TheResponse::success($data, 'Data Role', 200);
        } catch (\Exception $error) {
            return TheResponse::error([
                "message" => "Something went wrong",
                "error" => $error
            ], 'Autincate failed', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nama' => 'required',
            ]);

            $data = UserRole::find($id);
            $data->update($request->all());
            return TheResponse::success($data, 'Berhasil Merubah Role', 200);
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
            $data = UserRole::find($id);
            $data->delete();

            return TheResponse::success($data, 'Berhasil Menghapus Role', 200);
        } catch (\Exception $error) {
            return TheResponse::error([
                "message" => "Something went wrong",
                "error" => $error
            ], 'Autincate failed', 500);
        }
    }
}
