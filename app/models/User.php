<?php


class User
{
    private $db;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }
    public function findUserByEmail($email){
        $this->db->query('Select * from users where user_email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->getOne();
        if($this->db->rowCount() > 0){
            return true;
        }else {
            return false;
        }
    }
    public function register($data){
        $this->db->query('INSERT INTO users(user_name, user_email, user_password) values ( :name, :email, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()){
            return true;
        }else
            return false;
    }
    public function login($email, $password){
        $this->db->query('select * from users where user_email=:email');
        $this->db->bind(':email', $email);
        $user = $this->db->getOne();
        $hashedPassword = $user->user_password;
        if (password_verify($password, $hashedPassword )){
            return $user;

        }else {
            return false;
        }
    }

}
