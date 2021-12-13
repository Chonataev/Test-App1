<?php
namespace app\src\controllers; 
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\middlewares\AuthMiddleware;
use app\src\models\User;
use app\src\models\LoginForm;
use app\core\exception\ForbiddenException;

class AuthController extends Controller{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function home()
    {
        return $this->render('home');
    }

    public function login(Request $request)
    {
        if(Application::isGuest()){
            $loginForm = new LoginForm();
            if ($request->isPost()) {
                $loginForm->loadData($request->getBody());
                if ($loginForm->validate() && $loginForm->login()) {
                    Application::$app->response->redirect('/');
                    return;
                }
            }
            $this->setLayout('main');
            return $this->render('login', [
                'model' => $loginForm
            ]);
        }else{
            return $this->render('_error500');
        }
    }



    public function register(Request $request)
    {     
        
        if(Application::isGuest()){
            $user = new User();
        
            if($request->isPost()){
                $user->loadData($request->getBody());

                if($user->validate() && $user->save()){
                    Application::$app->session->setFlash('success', 'Thanks for registering');
                    Application::$app->response->redirect('/login');
                }
                return $this->render('register',[
                    'model' => $user
                ]);
            }

            $this->setLayout('main');
            return $this->render('register', [
                'model' => $user
            ]);
        }
        else{
            return $this->render('_error500');
        } 
        
    }
    
    public function logout()
    { 
        if(!Application::isGuest()){
            $response = new Response();
            Application::$app->logout();
            $response->redirect('/');
        }else{
            return $this->render('_error500'); 
        }
    }

    public function profile()
    {
        $user = Application::$app->user->getDisplayName();
        return $this->render('profile',
        ['user' => $user]);
    }
}