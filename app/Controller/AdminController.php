<?php


namespace App\Controller;

use App\Model\Message;
use Core\AbstractController;


class AdminController extends AbstractController
{
    public function preDispatch()
    {
        parent::preDispatch();
        if(!$this->getUser() || !$this->getUser()->isAdmin()) {
            $this->redirect('/');
        }
    }

    public function deleteMessage()
    {
        $messageId = (int) $_GET['id'];
        Message::deleteMessage($messageId);
        $this->redirect('/blog');
    }

    public function index()
    {
        return $this->deleteMessage();

    }
}
