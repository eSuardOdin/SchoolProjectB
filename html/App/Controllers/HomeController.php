<?php
declare(strict_types = 1);
namespace App\Controllers;

use App\View;

class HomeController 
{
    public function index(): string
    {
        return (string) View::make('/index');
        //return (new View('/index'))->render(); 
    }

    public function upload()
    {
        echo'<pre>';
        //echo exec('whoami') . '<br/>';
        var_dump($_FILES);

        var_dump(pathinfo($_FILES["uploaded_file"]["tmp_name"]));
        $file_path = STORAGE_PATH . '/' . $_FILES['uploaded_file']['name'];
        move_uploaded_file(
            $_FILES['uploaded_file']['tmp_name'],
            $file_path
        );
        var_dump(pathinfo($file_path));
        echo'</pre>';

    }
}