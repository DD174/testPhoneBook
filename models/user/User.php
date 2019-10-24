<?php
namespace models\user;

class User
{
    const FIELD_ID = 'id';
    const FIELD_LOGIN = 'login';
    const FIELD_EMAIL = 'email';
    const FIELD_PASSWORD = 'password';

    public $id;
    public $login;
    public $email;
    public $password;

    public function __construct($id = null, $login = null, $email = null, $password = null)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
    }
}