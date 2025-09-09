<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserData;
use Illuminate\Support\Facades\Validator;

class UserDataController extends Controller
{
    public function saveData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = UserData::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data saved successfully',
            'data' => $data,
        ]);
    }
    public function getData()
    {
        $userId = auth()->id();
    
        $data = \App\Models\UserData::where('user_id', $userId)->get();
    
        return response()->json([
            'status' => true,
            'message' => 'User data fetched successfully.',
            'data' => $data,
        ]);
    }
    public function deleteData($id)
    {
        $userId = auth()->id();
    
        $data = \App\Models\UserData::where('id', $id)
            ->where('user_id', $userId)
            ->first();
    
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found or unauthorized access.',
            ], 404);
        }
    
        $data->delete();
    
        return response()->json([
            'status' => true,
            'message' => 'Data deleted successfully.',
        ]);
    }

}
