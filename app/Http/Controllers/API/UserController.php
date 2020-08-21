<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = User::all();

        if ($request->query('role')) {
            $users = User::ofRole($request->query('role'))->get();
        }

        return response([
            'error' => false,
            'payload' => ['users' => $users]
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            return response([
                'error' => false,
                'payload' => ['user' => $user]
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'error' => true,
                'payload' => ['message' => 'User not found']
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role' => ['required', Rule::in(['patient', 'donor'])],
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'payload'=> ['errors' => $validator->errors()->all()]
            ], 422);
        }

        try {
            $user = User::findOrFail($id);

            $user->update(['role' => $request['role']]);

            return response([
                'error' => false,
                'payload' => ['user' => $user]
            ], 200);
        } catch (\Exception $exception) {
            return response([
                'error' => true,
                'payload' => ['message' => 'User not found']
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
