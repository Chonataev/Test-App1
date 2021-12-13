<?php
namespace app\src\controllers; 
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\src\models\User;
use app\src\models\LoginForm;
use app\core\exception\ForbiddenException;

class UserController extends Controller{

    public function __construct()
    {
        if(Application::isAdmin()){
           
        }
        else{
            throw new ForbiddenException();
        } 
    }

    public function list(Request $request){
        $sort = $request->getDetails();
        $start = $request->getDetail();
        $countPage = Application::$app->user->getCountPages();
        $users = Application::$app->user->getUserList($start,$sort);
        return $this->render('users/index',
        ['users' => $users,
        'countPage' => $countPage
    ]);  
    }

    public function detail(Request $request){
        $id = $request->getDetail();
        $user = Application::$app->user->getOneUser($id);
        return $this->render('users/detail',
        ['user' => $user]);  
    }

    public function update(Request $request){

        $id = $request->getDetail();
        $user = User::findOneById($id);
        if($request->isPost()){ 
            $user->loadData($request->getBody());
            if($user->updatevalidate() && $user->update($id)){
                Application::$app->session->setFlash('success', 'Record changed successfully');
                Application::$app->response->redirect('/users');
            }
            return $this->render('users/edit',[
                'model' => $user
            ]);
        }
        return $this->render('users/update',[
            'user' => $user
        ]);
    }
    public function delete(Request $request){
        $id = $request->getDetail();
        if(Application::$app->user->delete($id)){
            Application::$app->session->setFlash('success', 'Record deleted successfully');
            Application::$app->response->redirect('/users');
        }
        Application::$app->response->redirect('/users');
        return;
    }

}