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
        try {
            $exitCode = Artisan::call('backup:run');
            return redirect()->back()->with('message', 'Backup Database berhasil!');
        } catch (Exception $e) {
            report($e);
            
            return redirect()->back()->with('message', 'Backup Database berhasil!');
        }
    }
}
