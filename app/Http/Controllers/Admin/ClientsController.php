<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\{Client, User};
use Validator;
use Exception;
use Throwable;

class ClientsController extends Controller
{
    //
    public function index()
    {
        return view('admin.clients.index', ['title' => 'All Clients', 'clients' => Client::latest()->paginate(20)]);
    }

    //
    public function profile($id = 0)
    {
        return view('admin.clients.profile', ['title' => 'Client profile', 'client' => Client::findOrFail($id)]);
    }

    public function add()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'full_name' => ['required', 'string'], 
            'phone_number' => ['required', 'string'], 
            'address' => ['required', 'string'],
            'occupation' => ['required', 'string'],
            'dob' => ['required', 'string'],
        ], ['dob.required' => 'Client\'s date of birth is required']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $data['email'] ?? 0,
                'role' => 'client',
                'phone' => $data['phone_number'],
                'address' => $data['address'],
                'password' => Str::random(7),
            ]);

            Client::create([
                'fullname' => $data['full_name'],
                'dob' => $data['dob'],
                'occupation' => $data['occupation'],
                'phone' => $data['phone_number'],
                'address' => $data['address'],
                'user_id' => $user->id,
            ]);

            return response()->json([
                'status' => 1,
                'info' => 'Client added. Please wait . . .',
                'redirect' => '',
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 0,
                'info' => app()->environment() !== 'production' ? $e->getMessage() : 'Operation failed. Try again',
            ]);
        } catch (Throwable $e) {
            DB::rollback();
            return response()->json([
                'status' => 0,
                'info' => app()->environment() !== 'production' ? $e->getMessage() : 'Unknown error. Try again later',
            ]);
        }       
    }

    public function search()
    {
        $query = request()->get('search');
        $clients = Client::search(['fullname', 'title', 'occupation', 'address', 'phone', 'city', 'state', 'status'], $query)->paginate();
        return view('admin.clients.search')->with(['clients' => $clients]);
    }

}
