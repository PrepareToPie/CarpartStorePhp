<?php

use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CoreClass
{
    /**
     * Main functions
     */
    /**
     * Process request
     * @param Request $request
     */
    public function processRequest($request)
    {

        // PARSE REQUEST
        // Get request string as pattern: /controller/action/param1/param2
        $requestPaths = explode('/', $request->getPathInfo());
        // Get controller name
        if (empty($requestPaths[1])) {
            $controllerName = MVC_DEFAULT_CONTROLLER;
        } else {
            $controllerName = $requestPaths[1];
        }
        // Get action name
        if (empty($requestPaths[2])) {
            $actionName = MVC_DEFAULT_ACTION;
        } else {
            $actionName = $requestPaths[2];
        }
        // Get Path params
        if (count($requestPaths) >= 3) {
            $pathParams = array_slice($requestPaths, 3);
        } else {
            $pathParams = [];
        }

        // GET AND CALL ACTION
        $controllerClassName = 'ilsur\\Controller\\' . ucfirst($controllerName) . 'Controller';
        $controllerMethodName = $controllerClassName . '::' . 'action' . ucfirst($controllerName) . ucfirst($actionName);
        $pathParams[] = $request;
        $response = new Response(call_user_func_array($controllerMethodName, $pathParams));
        $response->send();
    }

    /**
     * Makes scope for view data, shows base template frame
     * and adds globals view variables (for all actions).
     *
     * @param string $view_name
     * @param array $data
     */
    private function loadView($view_name, $data)
    {
        /* ? Check $view_name ? */
        switch (substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2)) {
            case 'en':
                $viewsFolder = SITE_PATH . '/Views/en/';
                break;
            case 'ru':
                $viewsFolder = SITE_PATH . '/Views/ru/';
                break;
            default:
                $viewsFolder = SITE_PATH . '/Views/en/';
        }
        if (file_exists($viewsFolder . $view_name . '.inc.php')) {
            // Add global view variabls to this scope
            $user = CommonClass::get_authorized_user();
            // Make response
            require $viewsFolder . '_blocks/header.inc.php';
            require $viewsFolder . $view_name . '.inc.php';
            require $viewsFolder . '_blocks/footer.inc.php';
        } else {
            // In more complex system better use exceptions.
            exit('No such template: ' . $view_name . '.inc.php');
        }
    }

    public function createResponse($data, $status = 200)
    {
        ob_start();
        $this->loadView($data['view'], $data['data']);
        $content = ob_get_clean();
        return new Response($content, $status);
    }
//
//    /**
//     * Shows 403 page
//     */
//    public function error403() {
//        // Site has to have this template!
//        return [ 'view' => 'error_403', 'data' => []];
//    }
//
//    /**
//     * Shows 404 page for concrete thing that wasn't found.
//     *
//     * @param string $entity
//     */
//    public function error404($entity = 'page') {
//        // Site has to have this template!
//        return [ 'view' => 'error_404', 'data' => ['entity' => $entity]];
//    }

}