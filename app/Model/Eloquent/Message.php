<?php


namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Message
 * @package App\Model\Eloquent
 *
 * @property $text
 * @property-write $image
 * @property-write $author
 *
 */

class Message extends Model
{
    public $timestamps = false;
    protected $table = 'messages';
    protected $fillable = [
        'text',
        'author_id',
        'image',
    ];

    public function author()
    {
return $this->belongsTo(User::class);
    }

    public static function deleteMessage(int $messageId)
    {
return self::destroy($messageId);
    }

    public static function getList(int $limit = 10, int $offset = 0)
    {
        return self::with('author')
            ->limit($limit)
            ->offset($offset)
            ->orderBy('id', 'DESC')
            ->get();
    }


    public static function getUserMessages(int $userId, int $limit)
    {
return self::query()->where('author_id', '=', $userId)->limit($limit)->get();
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
    public function getText(): string
    {
        return $this->text;
    }


    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function getAuthor(): ?\App\Model\Eloquent\User
    {
        return $this -> author;
    }

    /**
     * @param \App\Model\Eloquent\User $author
     */
    public function setAuthor(\App\Model\Eloquent\User $author): void
    {
        $this -> author = $author;
    }

    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            $this->image = $this->genFileName();
            move_uploaded_file($file,getcwd() . '/images/' . $this->image);
        }
    }

    private function genFileName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
    }
    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'author_id' => $this->authorId,
            'image' => $this->image
        ];
    }

    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }
}