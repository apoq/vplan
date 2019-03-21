<?php

namespace App\Controllers\Api;

use App\Models\VpDaysQuery;
use App\Models\VpExercises;
use App\Models\VpExercisesQuery;
use App\Controllers\BaseController;
use System\Request;

/**
 * Class ExerciseController
 * @package App\Controllers\Api
 */
class ExerciseController extends BaseController
{
    /**
     * GET /api/v1/exercises
     */
    public function index()
    {
        $exercises = VpExercisesQuery::create()->find();

        $this->renderJson($exercises->toArray());
    }

    /**
     *  GET /api/v1/exercises/{id}
     */
    public function view($id)
    {
        $exercise = VpExercisesQuery::create()->findPk($id);

        if (!isset($exercise)) {
            return $this->respondNotFound();
        }

        $this->renderJson($exercise->toArray());
    }

    /**
     * POST /api/v1/exercises
     */
    public function create()
    {
        $exercise = new VpExercises();

        /** @var Request $request */
        $request    = app('request');
        $createData = $request->body;

        if (strlen($createData['title']) == 0) {
            return $this->respondUnprocessableEntity();
        }

        if (strlen($createData['day_id']) == 0) {
            return $this->respondUnprocessableEntity();
        }

        $day = VpDaysQuery::create()->findPk($createData['day_id']);
        if (!isset($day)) {
            return $this->respondUnprocessableEntity();
        }

        $exercise->setTitle($createData['title']);
        $exercise->setDayId($day->getId());

        try {
            $exercise->save();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondCreated($exercise->toArray());
    }

    /**
     * PUT /api/v1/exercises/{id}
     */
    public function update($id)
    {
        $exercise = VpExercisesQuery::create()->findPk($id);

        if (!isset($exercise)) {
            return $this->respondNotFound();
        }

        /** @var Request $request */
        $request    = app('request');
        $updateData = $request->body;

        if (strlen($updateData['title']) != 0) {
            $exercise->setTitle($updateData['title']);
        }

        try {
            $exercise->save();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondNoContent();
    }

    /**
     * DELETE /api/v1/exercises/{id}
     */
    public function delete($id)
    {
        $exercise = VpExercisesQuery::create()->findPk($id);

        if (!isset($exercise)) {
            return $this->respondNotFound();
        }

        try {
            $exercise->delete();
        } catch (\Exception $e) {
            return $this->respondError();
        }

        return $this->respondNoContent();
    }
}