<?php


class Users extends Controller
{

    /**
     * Users constructor.
     */
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = array(
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => $_POST['password'],
                'confirm_password' => $_POST['confirm_password'],
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'password_confirm_err' => ''
            );

            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter the name';
            }

            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter the email';
            }elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
               $data['email_err'] = 'Please enter valid email';
            }elseif ($this->userModel->findUserByEmail($data['email'])){
                $data['email_err'] = 'Email already taken!';
            }

            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter the password';
            } elseif (strlen($data['password']) < PASSWORD_LEN) {
                $data['password_err'] = 'Password length most be ' .PASSWORD_LEN. ' characters';
            }
            if(empty($data['confirm_password'])) {
                $data['password_confirm_err'] = 'Please confirm password';
            } elseif ($data['password']!= $data['confirm_password']){
                $data ['password_confirm_err'] = 'Passwords do not match';
            }elseif (strlen($data['confirm_password']) < PASSWORD_LEN) {
                $data['password_confirm_err'] = 'Password length most be ' .PASSWORD_LEN. ' characters';
            }

            if (empty($data['name_err']) and empty($data['email_err']) and empty($data['password_err']) and empty($data['password_confirm_err'])){
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                msg('register_success','Now you can login!');
                redirect('users/login');
                if ($this->userModel->register($data)){
                    echo 'ok, registered';
                } else {
                    die('something went wrong!');
                }
            }
        }else{

            $data = array(
                'name' => '',
                'email' => '',
                'password'=> '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'password_confirm_err' => ''
            );


        }
        $this->view('users/register', $data);
    }
    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); // to do
            $data = array(
                'email' => trim($_POST['email']),
                'password' => $_POST['password'],
                'email_err' => '',
                'password_err' => ''
            );

            if(empty($data['email'])){
                $data['email_err'] = 'Please enter the email';
            }
            if (!$this->userModel->findUserByEmail($data['email'])){
                $data['email_err'] = 'User email is not found';
             }

            if(empty($data['password'])){
                $data['password_err'] = 'Please enter the password';
            }

            if(empty($data['email_err']) and empty($data['password_err'])){
               $loggedInUser = $this->userModel->login($data['email'], $data ['password']);
               if ($loggedInUser){
                $this->createUserSession($loggedInUser);
               } else {
                   $data['password_err'] = 'Your password is incorrect!';
               }
            } else {
                echo ('Something went wrong');
            }

        } else {
            $data = array(
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            );
        }
        $this->view('users/login', $data);
    }
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_name'] = $user->user_name;
        $_SESSION['user_email'] = $user->user_email;
       redirect('pages/index');
    }
    public  function logout(){
        session_unset();
        session_destroy();
       redirect('users/login');
    }
}