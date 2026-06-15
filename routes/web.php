<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LabController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('menu');
    }
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'create'])->name('users.create');
Route::post('/register', [UserController::class, 'store'])->name('users.store');

Route::middleware('auth')->group(function () {
    Route::get('/menu', function () {
        return view('menu', [
            'completedModules' => auth()->user()->completedModuleKeys(),
            'totalModules'     => count(LabController::moduleKeys()),
        ]);
    })->name('menu');

    // Páginas de cada laboratório de vulnerabilidade.
    // Pages for each vulnerability lab.
    Route::view('/sql', 'sql')->name('sql');
    Route::view('/xss', 'xss')->name('xss');
    Route::view('/fileupload', 'fileupload')->name('fileupload');

    // Endpoints unificados de cada lab. O parâmetro {lab} deve bater com
    // uma das chaves configuradas em App\Http\Controllers\LabController::LABS.
    // Unified endpoints for each lab. The {lab} parameter must match
    // one of the keys configured in App\Http\Controllers\LabController::LABS.
    Route::post('/lab/{lab}/generate-victim', [LabController::class, 'generateVictim'])
        ->where('lab', 'sql|xss|fileupload')
        ->name('lab.generateVictim');
    Route::post('/lab/{lab}/validate-token', [LabController::class, 'validateToken'])
        ->where('lab', 'sql|xss|fileupload')
        ->name('lab.validateToken');

    Route::get('/perfil', function () {
        $user = auth()->user();
        $completed = $user->completedModuleKeys();
        $total = count(LabController::moduleKeys());

        return view('perfil', [
            'user'             => $user,
            'completedModules' => $completed,
            'totalModules'     => $total,
            'progressPercent'  => $total > 0 ? (int) round(count($completed) / $total * 100) : 0,
        ]);
    })->name('perfil');
    Route::get('/perfil/editar', [App\Http\Controllers\UserController::class, 'edit'])->name('perfil.edit');
    Route::post('/perfil/editar', [App\Http\Controllers\UserController::class, 'update'])->name('perfil.update');

    Route::resource('users', UserController::class)->except(['create', 'store']);
});
