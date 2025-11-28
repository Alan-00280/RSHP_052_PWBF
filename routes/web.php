<?php

// $request->session()->put([
//             'user_role_id' => $activeRoleUser->idrole_user,
//             'role_id' => $activeRoleUser->Role->idrole,
//             'role_name' => $activeRoleUser->Role->nama_role
//         ]);

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\masterController;
use App\Http\Controllers\siteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('home');
});

Route::get('/home', [siteController::class, 'home'])->name('home');
Route::get('/layanan', [siteController::class, 'layanan'])->name('layanan');
Route::get('/visi-misi', [siteController::class, 'visiMisi'])->name('visi-misi');
Route::get('/organisasi', [siteController::class, 'organisasi'])->name('organisasi');

Route::get('/idashboard', [dashboardController::class, 'index'])->name('dashboard');

//? DASHBOARD PAGES ?//
Route::middleware('isAdmin')->group(function () {
    Route::get('/dashboard/user', [dashboardController::class, 'user'])->name('user-data');
    Route::get('/dashboard/jenis-hewan', [dashboardController::class, 'jenisHewan'])->name('jenis-hewan-data');
    Route::get('/dashboard/ras-hewan', [dashboardController::class, 'rasHewan'])->name('ras-hewan-data');
    Route::get('/dashboard/ikategori', [dashboardController::class, 'kategori'])->name('kategori-data');
    Route::get('/dashboard/kategori-klinis', [dashboardController::class, 'kategoriKlinis'])->name('kategori-klinis-data');
    Route::get('/dashboard/kode-tindakan-terapi', [dashboardController::class, 'kodeTindakanTerapi'])->name('kategori-tindakan-terapi');
    Route::get('/dashboard/role', [dashboardController::class, 'Role'])->name('role');
}); 

Route::middleware('isResepsionis')->prefix('/dashboard/resepsionis')->group(function () {
    Route::get('/pet', [dashboardController::class, 'Pet'])->name('pet-resepsionis');
    Route::get('/pemilik', [dashboardController::class, 'Pemilik'])->name('pemilik-resep');
    Route::get('/temu-dokter', [dashboardController::class, 'TemuDokter'])->name('temu-dokter');
    Route::get('/pet', [dashboardController::class, 'Pet'])->name('pet');
});

//? Rekam Medis ?// 
Route::middleware([])->prefix('/dashboard')->group(function () {

    Route::get('/rekam-medis', [siteController::class, 'rekamMedis'])->name('rekam-medis');
    Route::get('/rekam-medis/{id}', [siteController::class, 'detilRekamMedis'])->name('detil-rkm-medis');
    
});

// 1. client login
// 2. di LoginController() ngecek role aktif nya apa
// 3. Redirect ke /dashboard/[role] --> ini akan sesuai role nya tadi
// 4. Router mengembalikan view dashboard
// 5. di dalam dashboard.blade.php akan dicek role nya
// 6. lalu menggunakan @use untuk memanggil view bersesuaian, jadi template dashboard nya satu, tapi isinya dashboard dipisah-pisah dan dipanggil di template dashboard.blade.php

//? DASHBOARD FUNCTIONAL PAGES ?//
Route::middleware('isAdmin')->group(function () {
    Route::get('/dashboard/create-user', [siteController::class, 'maintenanced'])->name('create-user-page');
    Route::get('/dashboard/create-jenis-hewan', [siteController::class, 'createJenisHewan'])->name('create-jenishewan-page');
});

Route::middleware('isResepsionis')->prefix('/resepsionis')->group(function () {
    Route::get('/edit-pet/{id}', [siteController::class, 'editPet'])->name('edit-pet');
});

//? API ROUTES ?//
Route::middleware('isAdmin')->group(function () {
    // Route::post('/create-user', [masterController::class, 'createUser'])->name('create-user-page');
    Route::post('/create-jenis-hewan', [masterController::class, 'createJenisHewan'])->name('create-jenis-hewan');

    Route::patch('/update-user/{id}', [masterController::class, 'updateUser'])->name('update-user');

    
});

Route::middleware('isResepsionis')->group(function () {
    Route::patch('/update-pet/{id}', [masterController::class, 'patchPet'])->name('update-pet');

    Route::patch('/update-pemilik/{id}', [masterController::class, 'patchPemilik'])->name('update-pemilik');

    Route::post('/create-pemilik', [masterController::class, 'postPemilik'])->name('create-pemilik');

    Route::get('/get-ras/{id}', [masterController::class, 'getRasbyJenis'])->name('get-ras-by-jenis');

    Route::post('/create-pet', [masterController::class, 'createPet'])->name('create-pet');
});


//? LOGOUT ROUTE ?//
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/home');
})->name('logout'); 

Auth::routes(['register' => false, 'reset' => false]);
