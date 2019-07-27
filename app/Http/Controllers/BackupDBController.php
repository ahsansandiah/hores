<?php

namespace App\Http\Controllers;

use Artisan;
use Exception;

class BackupDBController extends Controller
{
    public function index()
    {
        $path = env('APP_URL').'/storage/app/backupdb-temp/temp/db-dumps/';
        return view('contents.backupdb.index', compact('path'));
    }

    public function backup()
    {
        $exitCode = Artisan::call('backup:run');
        if ($exitCode) {
            return redirect()->back()->with('message', 'Backup Database berhasil!');
        } else {
            // return redirect()->back()->with('error_message', 'Backup Database berhasil!');
            throw new Exception("Backup Database berhasil!");
        }
    }
}
