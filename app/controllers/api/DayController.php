<?php

namespace App\Controllers\Api;

use App\Models\VpDays;
use App\Models\VpDaysQuery;
use App\Controllers\BaseController;
use System\Request;

/**
 * Class DayController
 * @package App\Controllers\Api
 */
class DayController extends BaseController
{
    /**
     * GET /api/v1/days
     */
    public function index()
    {
        $days = VpDaysQuery::create()->find();

        $this->renderJson($days->toArray());
    }

    /**
     * GET /api/v1/days/{id}
     */
    public function view($id)
    {
        $day = VpDaysQuery::create()->findPk($id);

        if (!isset($day)) {
            return $this->respondNotFound();
        }

        $this->renderJson($day->toArray());
    }

    /**
     * POST /api/v1/days
     */
    public function create()
    {
        $day = new VpDays();

        /** @var Request $request */
        $request    = app('request');
        $createData = $request->body;

        if (strlen($createData['title']) == 0) {
            return $this->respondUnprocessableEntity();
        }

        if (strlen($createData['plan_id']) == 0) {
            return $this->respondUnprocessableEntity();
        }

        $plan = VpDaysQuery::create()->findPk($createData['plan_id']);
        if (!isset($plan)) {
            return $this->respondUnprocessableEntity();
        }

        $day->setTitle($createData['title']);
        $day->setPlanId($plan->getId());

        try {
            $day->save();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondCreated($day->toArray());
    }

    /**
     * PUT /api/v1/days/{id}
     */
    public function update($id)
    {
        $day = VpDaysQuery::create()->findPk($id);

        if (!isset($day)) {
            return $this->respondNotFound();
        }

        /** @var Request $request */
        $request    = app('request');
        $updateData = $request->body;

        if (strlen($updateData['title']) != 0) {
            $day->setTitle($updateData['title']);
        }

        try {
            $day->save();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondNoContent();
    }

    /**
     * DELETE /api/v1/days/{id}
     */
    public function delete($id)
    {
        $day = VpDaysQuery::create()->findPk($id);

        if (!isset($day)) {
            return $this->respondNotFound();
        }

        try {
            $day->delete();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondNoContent();
    }
}