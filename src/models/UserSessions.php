<?php

namespace src\models;

use core\Model;
use Exception;

class UserSessions extends Model
{
    protected static string $table = 'user_sessions';
    public $id, $user_id, $hash;

    /**
     * @throws Exception
     */
    public static function findByUserId($user_id)
    {
        return self::findFirst([
            'conditions' => "user_id = :user_id",
            'bind' => ['user_id' => $user_id]
        ]);
    }

    /**
     * @throws Exception
     */
    public static function findByHash($hash)
    {
        return self::findFirst([
            'conditions' => "hash= :hash",
            'bind' => ['hash' => $hash]
        ]);
    }
}