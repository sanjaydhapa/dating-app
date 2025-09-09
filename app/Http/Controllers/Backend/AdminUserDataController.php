<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminUserDataController extends Controller
{
    public function index()
    {
        $dataList = UserData::with('user')->latest()->get();
        return view('backend.userdata.index', compact('dataList'));
    }

    public function create()
    {
        $users = User::select('id', 'name')->get();
        return view('backend.userdata.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        UserData::create($request->only(['user_id', 'name', 'email', 'phone']));

        return redirect()->route('admin.userdata.index')->with('success', 'Data saved successfully.');
    }

    public function destroy($id)
    {
        $data = UserData::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.userdata.index')->with('success', 'Data deleted successfully.');
    }
}
