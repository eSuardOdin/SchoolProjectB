<?php
declare(strict_types = 1);
namespace App\Classes;

class Home 
{
    public function index(): string
    {
        


        // // Cookie test
        // // Careful : - needs to be set before any output
        // //           - NO SENSITIVE DATAS
        // setcookie(
        //     'nom',
        //     'Erwann',
        //     time() + 10, 	// Expires in 10 seconds
        //     '/',			// Where is cookie available
        //     '',
        //     false,			// isHttps
        //     false,			// httpOnly
        // );
        // echo '<pre>';
        // var_dump($_COOKIE);
        // echo '</pre>';
        

        // Upload test
        return <<<FORM
        <form action="/upload" method="post" enctype="multipart/form-data">
            <input type="file" name="uploaded_file" />
            <button type="submit">Upload</button>
        </form>
        FORM;

        //return 'Home';
        
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