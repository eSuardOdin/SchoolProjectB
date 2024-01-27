<?php
declare(strict_types = 1);
namespace App\Classes;

class Home 
{
    public function index(): string
    {
        // Cookie test
        // Careful : - needs to be set before any output
        //           - NO SENSITIVE DATAS
        setcookie(
            'nom',
            'Erwann',
            time() + 10, 	// Expires in 10 seconds
            '/',			// Where is cookie available
            '',
            false,			// isHttps
            false,			// httpOnly
        );
        echo '<pre>';
        var_dump($_COOKIE);
        echo '</pre>';
        
        return 'Home';
        
    }
}