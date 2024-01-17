<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika pengguna tidak login dan bukan di halaman login, redirect ke halaman login
        if (!session()->get('username') && $request->uri->getPath() !== 'login') {
            return redirect()->to('/login');
        }
    }
    
    


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something after the request has been processed
    }
}
