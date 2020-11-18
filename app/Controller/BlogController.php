<?php
namespace App\Controller;

use App\Model\Message;
use App\Model\User;
use Core\AbstractController;

class BlogController extends AbstractController
{
    public function index()
    {
        if (!$this->getUser()) {
            $this->redirect('/login');
        }
        $messages = Message::getList();
        if ($messages) {
            $userIds = array_map(function (Message $message) {
                return $message->getAuthorId();
            }, $messages);
            $users = User::getByIds($userIds);
            array_walk($messages, function (Message $message) use ($users) {
                if (isset($users[$message->getAuthorId()])) {
                    $message->setAuthor($users[$message->getAuthorId()]);
                }
            });
        }
        return $this->view->render('blog.phtml'
            , [
            'messages' => $messages,
            'user' => $this->getUser()
        ]

        );
    }

    public function addMessage()
    {
        if (!$this->getUser()) {
            $this->redirect('/login');
        }

            $text = (string)$_POST['text'];

            if (!$text) {
                $this->error ('Сообщение не может быть пустым');
            }

            $data = [
                'text' => $text,
                'author_id' => $this->getUserId()
            ];

            $message = new Message($data);

        if (isset($_FILES['image']['tmp_name'])) {
            $message->loadFile($_FILES['image']['tmp_name']);
        }

            $message -> save();
        $this->redirect('/blog');

    }

//    public function twig()
//    {
//        return $this->view->renderTwig('test.twig', ['var' => 'ololo']);
//    }
//
    private function error()
    {

    }
    public function logout()
    {
        session_destroy();
    }
}