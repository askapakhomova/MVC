<?php


namespace App\Controller;

use App\Model\Eloquent\Message;
use Core\AbstractController;

class ApiController extends AbstractController
{
    public function index()
    {
        return $this->getUserMessages();
    }
    public function getUserMessages()
    {
        $userId = $_GET['user_id'] ?? 0;
        if (!$userId) {
            $this->response(['error' => 'no_user_id']);
        }
        $messages = Message::getUserMessages($userId, 20);
        if (!$messages) {
           return $this->response(['error' => 'no_message']);
        }

        $data = array_map(function (Message $message) {
            return $message->getData();
        }, $messages);
        return $this->response(['messages' => $data]);
    }

    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }

}