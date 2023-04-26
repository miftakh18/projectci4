<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Pages extends BaseController
{
    public function index()
    {
        $data['title'] = ucfirst('dashboard');
        return view('pages/dashboard', $data);
    }

    public function view($page = 'dashboard')
    {
        if (!is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException($page);
        }
        switch ($page) {
            case 'hmenu':
                $data['title'] = ucfirst('Header menu');
                break;
            default:
                $data['title'] = ucfirst($page);
                break;
        }


        return view('pages/' . $page, $data);
    }
}
