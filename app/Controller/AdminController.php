<?php


namespace App\Controller;

use App\Model\Eloquent\Message;

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
        $messageId = (int) $_POST['id'];
        Message::deleteMessage($messageId);

    }

    public function index()
    {
        return $this->deleteMessage();
    }

}
