<?php

namespace App\Controllers\Api;

use App\Models\VpPlans;
use App\Models\VpPlansQuery;
use App\Controllers\BaseController;
use App\Models\VpUsersPlans;
use App\Models\VpUsersPlansQuery;
use App\Models\VpUsersQuery;
use System\Request;

/**
 * Class PlanController
 * @package App\Controllers\Api
 */
class PlanController extends BaseController
{
    /**
     * GET /api/v1/plans
     */
    public function index()
    {
        $plans = VpPlansQuery::create()->find();

        $this->renderJson($plans->toArray());
    }

    /**
     * GET /api/v1/plan/{id}
     */
    public function view($id)
    {
        $plan = VpPlansQuery::create()->findPk($id);

        if (!isset($plan)) {
            return $this->respondNotFound();
        }

        $planUsers     = $plan->getVpUserss();
        $plan          = $plan->toArray();
        $plan['Users'] = $planUsers->toArray();

        $this->renderJson($plan);
    }

    /**
     * POST /api/v1/plans
     */
    public function create()
    {
        $plan = new VpPlans();

        /** @var Request $request */
        $request    = app('request');
        $createData = $request->body;

        if (strlen($createData['title']) == 0) {
            return $this->respondUnprocessableEntity();
        }

        $plan->setTitle($createData['title']);

        try {
            $plan->save();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondCreated($plan->toArray());
    }

    /**
     * PUT /api/v1/plans/{id}
     */
    public function update($id)
    {
        $plan = VpPlansQuery::create()->findPk($id);

        if (!isset($plan)) {
            return $this->respondNotFound();
        }

        /** @var Request $request */
        $request    = app('request');
        $updateData = $request->body;

        if (strlen($updateData['title']) != 0) {
            $plan->setTitle($updateData['title']);
        }

        try {
            $plan->save();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondNoContent();
    }

    /**
     * DELETE /api/v1/plans/{id}
     */
    public function delete($id)
    {
        $plan = VpPlansQuery::create()->findPk($id);

        if (!isset($plan)) {
            return $this->respondNotFound();
        }

        try {
            $plan->delete();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondNoContent();
    }

    /**
     * POST /api/v1/plans/{id}/users
     */
    public function addPlanUser($id)
    {
        $plan     = VpPlansQuery::create()->findPk($id);
        $planUser = new VpUsersPlans();

        if (!isset($plan)) {
            return $this->respondNotFound();
        }

        /** @var Request $request */
        $request = app('request');
        $data    = $request->body;

        if (!isset($data['user_id'])) {
            return $this->respondUnprocessableEntity();
        }
        $userId = $data['user_id'];

        $user = VpUsersQuery::create()->findPk($userId);
        if (!isset($user)) {
            return $this->respondUnprocessableEntity();
        }

        $planUser->setPlanId($plan->getId());
        $planUser->setUserId($user->getId());

        try {
            $planUser->save();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondCreated(['plan_id' => $planUser->getPlanId(), 'user_id' => $planUser->getUserId()]);
    }

    /**
     * DELETE /api/v1/plans/{id}/users/{$userId}
     */
    public function deletePlanUser($id, $userId)
    {
        $plan = VpPlansQuery::create()->findPk($id);

        if (!isset($plan)) {
            return $this->respondNotFound();
        }

        $planUser = VpUsersPlansQuery::create()->filterByPlanId($plan->getId())
                                     ->filterByUserId($userId)->findOne();

        if (!isset($planUser)) {
            return $this->respondNotFound();
        }

        try {
            $planUser->delete();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondNoContent();
    }
}