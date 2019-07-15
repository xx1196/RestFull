<?php

namespace App\Http\Controllers\user;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return User[]
     */
    public function index()
    {
        $users = User::all();

        return response(
            [
                'data' => $users
            ], 200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return Response
     */
    public function store(UserStoreRequest $request)
    {
        $fields = $request->all();
        $fields['verified'] = User::USER_NOT_VERIFIED;
        $fields['verification_token'] = User::generateVerifiedToken();
        $fields['admin'] = User::USER_REGULAR;
        $user = User::create(
            $fields
        );

        return response(
            [
                'data' => $user,
                'message' => "El usuario $user->name se ha creado con éxito",
            ], 200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function show(User $user)
    {
        return response(
            [
                'data' => $user
            ], 200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return void
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::USER_NOT_VERIFIED;
            $user->verification_token = User::generateVerifiedToken();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = $request->password;
        }

        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                return response(
                    [
                        'error' => 'Unicamente los usuarios verificados pueden ser administradores',
                        'code' => 409,
                    ],
                    409
                );
            }
            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            return response(
                [
                    'error' => 'Se debe especificar al menos un valor diferente para actualizar',
                    'code' => 422,
                ],
                422
            );
        }

        $user->save();

        return response(
            [
                'data' => $user,
                'message' => 'El usuario se ha actualizado con éxito',
            ], 200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(
            [
                'data' => $user,
                'message' => "El usuario $user->name se ha eliminado con éxito",
            ], 200
        );
    }
}
