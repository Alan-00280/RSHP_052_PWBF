<?php

// $request->session()->put([
//             'user_role_id' => $activeRoleUser->idrole_user,
//             'role_id' => $activeRoleUser->Role->idrole,
//             'role_name' => $activeRoleUser->Role->nama_role
//         ]);

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\siteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [siteController::class, 'home'])->name('home');
Route::get('/layanan', [siteController::class, 'layanan'])->name('layanan');
Route::get('/visi-misi', [siteController::class, 'visiMisi'])->name('visi-misi');
Route::get('/organisasi', [siteController::class, 'organisasi'])->name('organisasi');

Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

Route::middleware('isAdmin')->group(function () {
    Route::get('/dashboard/pemilik', [dashboardController::class, 'user'])->name('user-data');
    Route::get('/dashboard/jenis-hewan', [dashboardController::class, 'jenisHewan'])->name('jenis-hewan-data');
    Route::get('/dashboard/ras-hewan', [dashboardController::class, 'rasHewan'])->name('ras-hewan-data');
    Route::get('/dashboard/kategori', [dashboardController::class, 'kategori'])->name('kategori-data');
    Route::get('/dashboard/kategori-klinis', [dashboardController::class, 'kategoriKlinis'])->name('kategori-klinis-data');
    Route::get('/dashboard/kode-tindakan-terapi', [dashboardController::class, 'kodeTindakanTerapi'])->name('kategori-tindakan-terapi');
    Route::get('/dashboard/pet', [dashboardController::class, 'Pet'])->name('pet');
    Route::get('/dashboard/role', [dashboardController::class, 'Role'])->name('role');
});

Route::middleware('isResepsionis')->group(function () {
    Route::get('/dashboard/resepsionis/ras-hewan', [dashboardController::class, 'rasHewan'])->name('ras-hewan-data-resepsionis');
    Route::get('/dashboard/resepsionis/kategori', [dashboardController::class, 'kategori'])->name('kategori-data-resepsionis');
    Route::get('/dashboard/resepsionis/kategori-klinis', [dashboardController::class, 'kategoriKlinis'])->name('kategori-klinis-data-resepsionis');
    Route::get('/dashboard/resepsionis/kode-tindakan-terapi', [dashboardController::class, 'kodeTindakanTerapi'])->name('kategori-tindakan-terapi-resepsionis');
    Route::get('/dashboard/resepsionis/pet', [dashboardController::class, 'Pet'])->name('pet-resepsionis');
});

// 1. client login
// 2. di LoginController() ngecek role aktif nya apa
// 3. Redirect ke /dashboard/[role] --> ini akan sesuai role nya tadi
// 4. Router mengembalikan view dashboard
// 5. di dalam dashboard.blade.php akan dicek role nya
// 6. lalu menggunakan @use untuk memanggil view bersesuaian, jadi template dashboard nya satu, tapi isinya dashboard dipisah-pisah dan dipanggil di template dashboard.blade.php

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/home');
}); 

Auth::routes(['register' => false, 'reset' => false]);
