<?php

namespace src\models;

use core\helpers\GenerateToken;
use core\Model;
use core\validators\EmailValidator;
use core\validators\MatchesValidator;
use core\validators\MinValidator;
use core\validators\RequiredValidator;
use core\validators\UniqueValidator;
use Exception;

class AdminUsers extends Model
{
    protected static string $table = "users";
    public $id, $created_at, $updated_at, $username, $fname, $lname, $user_id, $email, $img, $password, $confirmPassword, $acl = 'guests', $gender = 'others', $ref_link, $state, $country, $address, $blocked = 0, $terms = 0, $verified = 0, $remember = '';

    const GUESTS_PERMISSION = 'guests';
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

        $this->runValidation(new RequiredValidator($this, ['field' => 'username', 'msg' => 'UserName is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'fname', 'msg' => 'First Name is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'lname', 'msg' => 'Last Name is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'state', 'msg' => 'State is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'country', 'msg' => 'Country is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'address', 'msg' => 'Address is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'acl', 'msg' => 'Access Level is required']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'gender', 'msg' => 'Gender is required']));

        $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => 'E-Mail is required']));
        $this->runValidation(new EmailValidator($this, ['field' => 'email', 'msg' => 'You must provide a valid E-Mail.']));
        $this->runValidation(new UniqueValidator($this, ['field' => ['email'], 'msg' => 'User with E-Mail Already Exists.']));

        if ($this->isNew()) {
            $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'msg' => 'Password is a required Field']));
            $this->runValidation(new RequiredValidator($this, ['field' => 'confirmPassword', 'msg' => "Confirm Password is a required Field."]));
            $this->runValidation(new MatchesValidator($this, ['field' => 'confirmPassword', 'rule' => $this->password, 'msg' => "Passwords do not match."]));
            $this->runValidation(new MinValidator($this, ['field' => 'password', 'rule' => 5, 'msg' => "Password must be at least 5 characters."]));
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            $this->terms = 1;
            $this->user_id = GenerateToken::randomString(6);
            $this->ref_link = GenerateToken::randomString(6);

        } else {
            $this->_skipUpdate = ['password'];
        }
    }
}