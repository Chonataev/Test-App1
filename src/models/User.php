<?php


namespace app\src\models;


use app\core\DbModel;
use app\core\UserModel;

class User extends UserModel
{
    public int $id = 0;
    public string $firstname = '';
    public string $lastname = '';
    public string $gender = '';
    public string $DOB = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password','DOB','gender'];
    }
    
    public function updateAttributes(): array
    {
        return ['firstname', 'lastname','DOB','gender','id'];
    }

    public function labels(): array
    {
        return [
            'firstname'       => 'First name',
            'lastname'        => 'Last name',
            'email'           => 'Email',
            'password'        => 'Password',
            'passwordConfirm' => 'Password Confirm',
            'DOB'             => 'DOB',
            'gender'          => 'gender',
        ];
    }

    public function updaterules(): array
    {
        {
            return [
                "firstname" => [self::RULE_REQUIRED],
                "lastname" => [self::RULE_REQUIRED],
                "DOB" => [self::RULE_REQUIRED],
                "gender" => [self::RULE_REQUIRED],
            ];
        }
    }


    public function rules(): array
    {
        return [
            "firstname" => [self::RULE_REQUIRED],
            "lastname" => [self::RULE_REQUIRED],
            "DOB" => [self::RULE_REQUIRED],
            "gender" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL,[
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            "password" => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => '6'], [self::RULE_MAX, 'max' => '16']],
            "passwordConfirm" => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return parent::save();
    }

    public function update($id)
    {
        return parent::update($id);
    }

    public function getDisplayName()
    {
        $user = User::findOneById(\app\core\Application::$app->user->id);
        return $user;
    }

    public function getUserList($count,$sort)
    {
        $users = User::findAll($count,$sort);
        if (!$users) {
            $this->addError('There are no entries in the user table');
            return false;
        }
        return $users;
    }

    public function getCountPage()
    {
        return User::getCountPage();
    }

    public function getOneUser($id){
        $user = User::findOneById($id);
        return $user;
    }
    public function removeUser($id){
        $user = User::findOneById($id);
        return $user;
    }
}