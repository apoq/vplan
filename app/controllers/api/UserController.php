<?php

namespace App\Controllers\Api;

use App\Models\VpUsers;
use App\Models\VpUsersQuery;
use App\Controllers\BaseController;
use System\Request;

/**
 * Class UserController
 * @package App\Controllers\Api
 */
class UserController extends BaseController
{
    /**
     * GET /api/v1/users
     */
    public function index()
    {
        $users = VpUsersQuery::create()->find();

        $this->renderJson($users->toArray());
    }

    /**
     * GET /api/v1/users/{id}
     */
    public function view($id)
    {
        $user = VpUsersQuery::create()->findPk($id);

        if (!isset($user)) {
            return $this->respondNotFound();
        }

        $this->renderJson($user->toArray());
    }

    /**
     * POST /api/v1/users
     */
    public function create()
    {
        $user = new VpUsers();

        /** @var Request $request */
        $request    = app('request');
        $createData = $request->body;

        if (strlen($createData['email']) == 0) {
            return $this->respondUnprocessableEntity();
        }

        if (strlen($createData['first_name']) == 0) {
            return $this->respondUnprocessableEntity();
        }

        if (strlen($createData['last_name']) == 0) {
            return $this->respondUnprocessableEntity();
        }

        $user->setEmail($createData['email']);
        $user->setFirstName($createData['first_name']);
        $user->setLastName($createData['last_name']);

        try {
            $user->save();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondCreated($user->toArray());
    }

    /**
     * PUT /api/v1/users/{id}
     */
    public function update($id)
    {
        $user = VpUsersQuery::create()->findPk($id);

        if (!isset($user)) {
            return $this->respondNotFound();
        }

        /** @var Request $request */
        $request    = app('request');
        $updateData = $request->body;

        if (strlen($updateData['email']) != 0) {
            $user->setEmail($updateData['email']);
        }

        if (strlen($updateData['first_name']) != 0) {
            $user->setFirstName($updateData['first_name']);
        }

        if (strlen($updateData['last_name']) != 0) {
            $user->setLastName($updateData['last_name']);
        }

        try {
            $user->save();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondNoContent();
    }

    /**
     * DELETE /api/v1/users/{id}
     */
    public function delete($id)
    {
        $user = VpUsersQuery::create()->findPk($id);

        if (!isset($user)) {
            return $this->respondNotFound();
        }

        try {
            $user->delete();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondNoContent();
    }
}