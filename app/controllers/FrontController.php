<?php

namespace App\Controllers;

use App\Models\VpPlansQuery;
use App\Models\VpUsersQuery;

/**
 * Class FrontController
 * @package App\Controllers
 */
class FrontController extends BaseController
{
    /**
     * GET /
     */
    public function index()
    {
        $this->render('front/index.html');
    }

    /**
     * GET /plans
     */
    public function plans()
    {
        $plans = VpPlansQuery::create()->find();

        $this->render('front/plans.html', ['plans' => $plans->toArray()]);
    }

    /**
     * GET /users
     */
    public function users()
    {
        $users = VpUsersQuery::create()->find();

        $this->render('front/users.html', ['users' => $users->toArray()]);
    }
}