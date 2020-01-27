<?php


namespace ilsur\Controller;


use ilsur\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * Show all users.
     * @Route("")
     * @return Response
     */
    static function actionUserList()
    {
        // Process request with using of models
        $profiles = User::getUserList();
        $message = '';
        if (isset($_GET['status']) && $_GET['status'] === 'registered') {
            $message = 'You has been registered!';
        }
//        ob_start();
//        load_view("UserList", [
//            'profiles' => $profiles,
//            'message' => $message
//        ]);
//        $content = ob_get_clean();
//        // Make Response Data
//        $response = new Response($content, 200);
        return (new \CoreClass)->createResponse(['view' => 'user/list', 'data' => [
            'profiles' => $profiles,
            'message' => $message
        ]]);
//        return ['view' => 'user/list',
//            'data' => [
//                'profiles' => $profiles,
//                'message' => $message
//            ]];
    }

    /**
     * Show user profile.
     *
     * @param int $id Id user to show.
     * @return Response
     */
    static function actionUserShow($id)
    {
        // Process request with using of models
        $id = (int)$id;
        $profile = ($t = (new User())->getProfileData($id));
        // Make Response Data
        if ($profile !== NULL) {
            return (new \CoreClass)->createResponse(['view' => 'user/show',
                'data' => [
                    'profile' => $profile,
                ]]);
        } else {
            return (new \CoreClass)->createResponse(null, 404);
        }
    }
}