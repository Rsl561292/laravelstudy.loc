<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function getIndex()
    {
        $view = view('test\site\index');
        $view->with('userName', $this->getUserName());
        $view->with('pageName', 'Home page Admin');

        return $view;

    }


    public function getLogin()
    {
        if(view()->exists('test\site\login')) {

            return view('test\site\login', [
                'userName' => $this->getUserName(),
                'pageName' => 'Sign in admin particle'
            ]);
        } else {
            return redirect()->route('home');
        }

    }

    public function postSignIn()
    {

        if(isset($_REQUEST['user_slug']) && !empty($_REQUEST['user_slug'])) {

            $listUser = config('parameters.listUser');
            $userSlug = $_REQUEST['user_slug'];

            if(isset($listUser[$userSlug])) {

                setcookie('user', json_encode([
                    'name' => $listUser[$userSlug],
                    'slug' => $userSlug,
                ]), time() + (60*60*24));
            } else {
                return redirect()->route('admin-login');
            }
        } else {
            return redirect()->route('admin-login');
        }

        return redirect()->route('admin-home');

    }

    public function getLogout()
    {

        if (isset($_COOKIE['user'])) {

            setcookie('user', null);
        }

        return redirect()->route("admin-home");

    }

    public function getListUser()
    {
        return view('test\site\list-user', [
            'userName' => $this->getUserName(),
            'listUser' => config('parameters.listUser'),
        ]);
    }

    public function getUser($slug)
    {
        $listUser = config('parameters.listUser');
        $userViewName = isset($listUser[$slug]) ? $listUser[$slug] : '';

        return view('test\site\view-user', [
            'userName' => $this->getUserName(),
            'userViewName' => $userViewName,
        ]);
    }

    private function getUserName()
    {
        $userName = '';

        if(isset($_COOKIE['user'])) {

            $user = json_decode($_COOKIE['user']);

            $userName = $user->name;
        }

        return $userName;
    }
}
