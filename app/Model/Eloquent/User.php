<?php


namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent;
/**
 * Class User
 * @package App\Model\Eloquent
 *
 * @property $id
 * @property-write $password
 * @property-write $login
 * @property-write $email
 */
class User extends Eloquent\Model
{
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = [
        'login',
        'password',
        'email',
    ];

    public static function getByEmail(string $email)
    {
return self::query()->where('email', '=', $email)->first();
    }

    public static function getById(int $id)
    {
return self::query()->find($id);
    }

    public static function getList(int $limit = 10, int $offset = 0)
    {

        return self::query()->limit($limit)->offset($offset)->orderBy('id', 'DESC')->get();
    }

    public static function getPasswordHash(string $password)
    {
        return sha1('.,f.akjsduf' . $password);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return$this->email;
    }

    public function isAdmin(): bool
    {
        return in_array($this->id, ADMIN_IDS);
    }

}