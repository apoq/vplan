<?php

namespace App\Controllers;

use App\Models\VpExercisesQuery;
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
     * GET /plans/{id}
     */
    public function plan($id)
    {
        $plan = VpPlansQuery::create()->leftJoinWithVpDays()->findPk($id);
        $users = VpUsersQuery::create()->find();

        if (!isset($plan)) {
            return $this->respondNotFound();
        }

        $users = $users->toArray();
        $planUsers = $plan->getVpUserss();
        $planDays = $plan->getVpDayss();
        $dayIds = $planDays->getColumnValues('id');
        $plan = $plan->toArray();
        $plan['users'] = $planUsers->toArray();
        $plan['days'] = $planDays->toArray();
        $userIds = $planUsers->getColumnValues('id');
        $exercises = VpExercisesQuery::create()->where('day_id in (?)', $dayIds, \PDO::PARAM_INT)->find()->toArray();

        foreach($plan['days'] as $k => $day) {
            foreach ($exercises as $exercise) {
                if ($exercise['DayId'] == $day['Id']) {
                    $plan['days'][$k] = $exercise;
                }
            }
        }

        foreach ($users as $k => $user) {
            if (in_array($user['Id'], $userIds)) {
                $users[$k]['active'] = true;
            } else {
                $users[$k]['active'] = false;
            }
        }

        $this->render('front/plan.html', ['plan' => $plan, 'users' => $users]);
    }

    /**
     * GET /plans/create
     */
    public function createPlan()
    {
        $this->render('front/plan_create.html');
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