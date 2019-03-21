<?php

namespace App\Controllers;

use App\Models\VpUsersQuery;

/**
 * Class WidgetController
 * @package App\Controllers
 */
class WidgetController extends BaseController
{
    /**
     * GET /widgets/users/{id}
     */
    public function ajaxUser($id)
    {
        $user = VpUsersQuery::create()->findPk($id);

        if (!isset($user)) {
            return $this->respondNotFound();
        }
        $this->render('widgets/tr.user.html', ['user' => $user->toArray()]);
    }
}