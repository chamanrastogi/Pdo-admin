<?php
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out
// Keep in mind when working with sessions that it is generally
// inadvisable to store DB-related objects in sessions
class Session
{

    private $logged_in = false;
    public $user_id;
    public $role;
    public $last_login_timestamp;
    public $tokken;
    public $message;

    function __construct()
    {
        session_start();
        $this->check_message();
        $this->check_login();
        if ($this->logged_in)
        {
            // actions to take right away if user is logged in
            
        }
        else
        {
            // actions to take right away if user is not logged in
            
        }
    }

    public function is_logged_in()
    {
        return $this->logged_in;
    }
    public static function getToken()
    {
        return md5(uniqid(rand() , true));
    }
    public function login($user)
    {
        // database should find user based on username/password
        if ($user)
        {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->role = $_SESSION['role'] = $user->role;
            $this->last_login_timestamp = $_SESSION['last_login_timestamp'] = time();
            $this->tokken = $_SESSION['tokken'] = $this->getToken();
            $this->logged_in = true;
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['role']);
        unset($_SESSION['last_login_timestamp']);
        //unset($_SESSION['tokken']);
        unset($this->user_id);
        unset($this->role);
        unset($this->last_login_timestamp);
        //unset($this->tokken);
        $this->logged_in = false;
    }

    public function message($msg = "")
    {
        if (!empty($msg))
        {
            // then this is "set message"
            // make sure you understand why $this->message=$msg wouldn't work
            $_SESSION['message'] = $msg;
        }
        else
        {
            // then this is "get message"
            return $this->message;
        }
    }

    private function check_login()
    {
        if (isset($_SESSION['user_id']))
        {
            $this->user_id = $_SESSION['user_id'];
            $this->role = $_SESSION['role'];
            $this->logged_in = true;
        }
        else
        {
            unset($this->user_id);
            unset($this->role);
            $this->logged_in = false;
        }
    }

    private function check_message()
    {
        // Is there a message stored in the session?
        if (isset($_SESSION['message']))
        {
            // Add it as an attribute and erase the stored version
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        else
        {
            $this->message = "";
        }
    }

}

$session = new Session();
$message = $session->message();

?>
