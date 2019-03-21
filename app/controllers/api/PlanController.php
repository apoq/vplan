<?php

namespace App\Controllers\Api;

use App\Models\VpPlans;
use App\Models\VpPlansQuery;
use App\Controllers\BaseController;
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
}