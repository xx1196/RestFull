<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return User[]
     */
    public function index()
    {
        $users = User::all();

        return $this->showAll($users);
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
            ], 201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return $this->showOne($user);
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
                return $this->errorResponse('Unicamente los usuarios verificados pueden ser administradores', 409);
            }
            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            return $this->errorResponse("No se encuentra cambios para el usuario $user->name", 422);
        }

        $user->save();

        return $this->showOne($user, "El usuario $user->name se ha modificado con éxito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->forceDelete();

        return $this->showOne($user, "El usuario $user->name se ha eliminado de forma permanente con éxito");
    }

    public function deactivated(User $user)
    {
        $user->delete();

        return $this->showOne($user, "El usuario $user->name se ha desactivado con éxito");
    }

    public function deactivatedUsers()
    {
        $users = User::onlyTrashed()->get();

        return $this->showAll($users);
    }

    public function activated(User $user)
    {
        $user->restore();

        return $this->showOne($user, "El usuario $user->name se ha activado con éxito");
    }
}
