<?php

namespace App\Http\Controllers\API;

use App\Models\Super\Menu;
use App\Helpers\TheResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class MenuApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data = Menu::with('access')->get();
            return TheResponse::success($data, 'Data Menu', 200);
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
                'title' => 'required',
                'url' => 'required',
                'icon' => 'required',
            ]);

            $data = Menu::create($request->all());
            return TheResponse::success($data, 'Berhasil Menambah Menu', 200);
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
        if (!$id) {
            return TheResponse::error([
                "message" => "Something went wrong",
                "error" => $id = null
            ], 'Autincate failed', 500);
        }

        try {
            $data = Menu::with('access')->find($id);
            return TheResponse::success($data, 'Data Menu', 200);
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
                'title' => 'required',
                'icon' => 'required',
                'url' => 'required',
            ]);

            $data = Menu::find($id);
            $data->update($request->all());
            return TheResponse::success($data, 'Berhasil Memperbaharui', 200);
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
            $data = Menu::find($id);
            $data->delete();
            return TheResponse::success($data, 'Berhasil Menghapus Menu', 200);
        } catch (\Exception $error) {
            return TheResponse::error([
                "message" => "Something went wrong",
                "error" => $error
            ], 'Autincate failed', 500);
        }
    }
}
