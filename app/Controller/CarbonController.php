<?php
namespace App\Controller;

use Carbon\Carbon;
use Core\AbstractController;


class CarbonController extends AbstractController
{

    public function index()
    {
        return $this->carbonAction();
    }
public function carbonAction()
{


    $oldTime = Carbon::now();
    Carbon::setLocale('ru');

  echo $oldTime->diffForHumans($oldTime);
}
}