<?php

namespace src\models;

use core\Config;
use core\Cookie;
use core\Model;
use core\Session;
use core\validators\EmailValidator;
use core\validators\MatchesValidator;
use core\validators\MinValidator;
use core\validators\RequiredValidator;
use core\validators\UniqueValidator;
use Exception;

class Users extends Model
{
    protected static $_current_user = false;
    protected static string $table = "users";
    public $id, $created_at, $updated_at, $surname, $firstname, $lastname, $user_id, $email, $img, $password, $confirmPassword, $acl = 'guests', $gender = 'others', $state, $country, $address, $status = 'active', $blocked = 0, $remember = '';

    const AUTHOR_PERMISSION = 'author';
    const ADMIN_PERMISSION = 'admin';

    const MALE_GENDER = 'male';
    const FEMALE_GENDER = 'female';

    /**
     * @throws Exception
     */
    public function beforeSave()
    {
        $this->timeStamps();

        $this->runValidation(new RequiredValidator($this, ['field' => 'surname', 'msg' => 'Surname is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'firstname', 'msg' => 'FirstName is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'lastname', 'msg' => 'LastName is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'state', 'msg' => 'State is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'country', 'msg' => 'Country is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'address', 'msg' => 'Address is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'acl', 'msg' => 'Rank is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'gender', 'msg' => 'Gender is required']));

        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => 'E-Mail is required']));
        $this->runValidation(new EmailValidator($this, ['field' => 'email', 'msg' => 'You must provide a valid E-Mail.']));
        $this->runValidation(new UniqueValidator($this, ['field' => ['email', 'surname'], 'msg' => 'User with E-Mail Already Exists.']));

        if ($this->isNew()) {
            $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'msg' => 'Password is a required Field']));
            $this->runValidation(new RequiredValidator($this, ['field' => 'confirmPassword', 'msg' => "Confirm Password is a required Field."]));
            $this->runValidation(new MatchesValidator($this, ['field' => 'confirmPassword', 'rule' => $this->password, 'msg' => "Passwords do not match."]));
            $this->runValidation(new MinValidator($this, ['field' => 'password', 'rule' => 5, 'msg' => "Password must be at least 5 characters."]));
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        } else {
            $this->_skipUpdate = ['password'];
        }
    }

    /**
     * @throws Exception
     */
    public function validateLogin()
    {
        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => "E-Mail is a required Field"]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'msg' => "Password is a required Field"]));
    }


    /**
     * Login Function, that set to remember token
     * and determine if cookie is set for auto login or not
     *
     * @param boolean $remember
     * @return void
     * @throws Exception
     */
    public function login(bool $remember = false)
    {
        Session::set('logged_in_user', $this->id);
        self::$_current_user = $this;
        if ($remember) {
            $now  = time();
            $newHash = md5("{$this->id}_{$now}");
            $session = UserSessions::findByUserId($this->id);
            if (!$session) {
                $session = new UserSessions();
            }
            $session->user_id = $this->id;
            $session->hash = $newHash;
            $session->save();
            Cookie::set(Config::get('login_cookie_name'), $newHash, 60 * 60 * 24 * 30);
        }
    }

    /**
     * This Function login user automatically from the cookie
     * @return false
     * @throws Exception
     * @author Celio Natti <Celionatti@gmail.com>
     * @version 1.0.0
     *
     */
    public static function loginFromCookie()
    {
        $cookieName = Config::get('login_cookie_name');
        if (!Cookie::exists($cookieName)) return false;
        $hash = Cookie::get($cookieName);
        $session = UserSessions::findByHash($hash);
        if (!$session) return false;
        $user = self::findById($session->user_id);
        if ($user) {
            $user->login(true);
        }
    }

    /**
     * This function Logout a current UserSessions
     * And also clear user Application Cookie.
     * @return void
     * @throws Exception
     * @author Celio Natti <Celionatti@gmail.com>
     * @version 1.0.0
     *
     */
    public function logout()
    {
        Session::delete('logged_in_user');
        self::$_current_user = false;
        $session = UserSessions::findByUserId($this->id);
        if ($session) {
            $session->delete();
        }
        Cookie::delete(Config::get('login_cookie_name'));
    }

    /**
     * This function get the current user logged in the application
     * @return void
     * @throws Exception
     * @author Celio Natti <Celionatti@gmail.com>
     * @version 1.0.0
     *
     */
    public static function getCurrentUser()
    {
        if (!self::$_current_user && Session::exists('logged_in_user')) {
            $user_id = Session::get('logged_in_user');
            self::$_current_user = self::findById($user_id);
        }
        if (!self::$_current_user) self::loginFromCookie();
        if (self::$_current_user && self::$_current_user->blocked) {
            self::$_current_user->logout();
            Session::msg("You are currently blocked. Please talk to an admin to resolve this.");
        }
        return self::$_current_user;
    }

    public function hasPermission($acl)
    {
        if (is_array($acl)) {
            return in_array($this->acl, $acl);
        }
        return $this->acl == $acl;
    }

    public function displayName(): string
    {
        return trim($this->username);
    }

}