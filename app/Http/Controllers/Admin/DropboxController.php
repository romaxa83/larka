<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Kunnu\Dropbox\{Dropbox, DropboxApp, DropboxFile};

class DropboxController extends Controller
{

    public function index()
    {
        $title = 'Dropbox';

        $app = new DropboxApp(
            'gt5ua1x12xhya11',
            'i8yyh0kkywom17m',
            'rGi-gG3jieAAAAAAAAAAS6QFfcjE3jvtKdhjD8fp9PkHEsUcP5sEFMVH2CXCwTD3'
        );

        $dropbox = new Dropbox($app);
//https://sitkodenis.ru/prostaya-rabota-s-dropbox-api/
        // DropboxAuthHelper
        $authHelper = $dropbox->getAuthHelper();

        $listFolderContents = $dropbox->listFolder('/');

        dd($listFolderContents);

        return view('admin.dropbox.index', compact( 'title'));
    }
}