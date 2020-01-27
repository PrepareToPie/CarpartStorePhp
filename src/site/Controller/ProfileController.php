<?php


namespace ilsur\Controller;


use Symfony\Component\HttpFoundation\Response;

class ProfileController
{
    /**
     * Show current user's profile
     *
     * @return Response
     */
    static function actionProfileShow()
    {
        // Process request with using of models
        $user = \CommonClass::get_authorized_user();
        // Make Response Data
        if ($user !== NULL) {
            $data = [
                'profile' => $user,
            ];
            return (new \CoreClass)->createResponse(['view' => 'user/show', 'data' => $data], 200);
        } else {
            return (new \CoreClass)->createResponse(null, 403);
        }
    }
}