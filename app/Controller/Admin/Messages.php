<?php


namespace App\Controller\Admin;

use App\Controller\AdminController;
use App\Model\Eloquent\Message;

class Messages extends AdminController
{
    public function index()
    {
        return $this -> view -> render('admin/messages.phtml'
            , [
           "messages" => Message::getList()
            ]
        );
    }

    public function deleteUserMessage()
    {
        $messageId = (int) $_POST['id'];
        Message::deleteMessage($messageId);
    }

    public function addMessage()
    {
        $text = (string) $_POST['text'];

        if (!$text) {
            $this -> error('Сообщение не может быть пустым');
        }

        $data = [
            'text' => $text,
            'author_id' => $this -> getUserId(),
        ];


        $message = new Message($data);
        if (isset($_FILES['image']['tmp_name'])) {
            $message -> loadFile($_FILES['image']['tmp_name']);
        }

        $message->save();

    }


    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }

}