<?php


namespace App\Controller;

use Core\AbstractController;
use GUMP;


class GumpController extends AbstractController
{

    public function index()
    {
        return $this -> gumpAction();
    }

    public function gumpAction()
    {
        $data = [
            'username' => 'Asya123',
            'password' => 'ForLoftSchool',
            'email' => 'aska-pakhomova.87@mail.ru',
            'gender' => 'f'
        ];

        $gump = new GUMP();
        $gump->validation_rules(array(
            'username'    => 'required|alpha_numeric|max_len,100|min_len,6',
            'password'    => 'required|max_len,100|min_len,6',
            'email'       => 'required|valid_email',
            'gender'      => 'required|exact_len,1|contains,m f'
        ));

//        $rules = $gump->filter_rules(array(
//            'username' 	  => 'trim|sanitize_string|mysql_escape',
//            'password'	  => 'trim|base64',
//            'email'    	  => 'trim|sanitize_email',
//            'gender'   	  => 'trim'
//        ));

        $validated_data = $gump->run($data);

        if($validated_data === false) {
            echo $gump->get_readable_errors(true);
        } else {
             var_dump($validated_data); // validation successful
        }
    }
}