    <?php

    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\MahasiswaController;
    use App\Http\Controllers\RuanganController;
    use App\Http\Controllers\MatkulController;
    use App\Http\Controllers\DosenController;
    use App\Http\Controllers\Auth\StudentRegisterController;
    use App\Http\Controllers\EkycController;
    use App\Http\Controllers\Admin\EkycAdminController;
    use App\Http\Controllers\LandingController;

    use App\Http\Controllers\Admin\LandingSettingController;
    use App\Http\Controllers\Admin\LandingNavController;
    use App\Http\Controllers\Admin\LandingProgramController;
    use App\Http\Controllers\Admin\LandingFooterController;
    use Illuminate\Http\Request;    


    use Illuminate\Support\Facades\Route;

    // Route::get('/', function () {
    // return view('welcome');
    // });

    Route::get('/', [LandingController::class, 'index'])->name('home');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', function (Request $request) {
            $user = $request->user();

            if ($user->role === 'admin') {
                return view('dashboard.admin'); 
            } else {
                return view('dashboard.user');
            }
        })->name('dashboard');
    });


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // mahasiswa
        Route::get('/mahasiswa', [MahasiswaController::class,'index'])->name('mahasiswa.index');
        Route::post('/mahasiswa', [MahasiswaController::class,'store'])->name('mahasiswa.store');
        Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

        //Matkul
        Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul.index');
        Route::post('/matkul', [MatkulController::class, 'store'])->name('matkul.store');
        Route::get('/matkul/{id}/edit', [MatkulController::class, 'edit'])->name('matkul.edit');
        Route::put('/matkul/{id}', [MatkulController::class, 'update'])->name('matkul.update');
        Route::delete('/matkul/{id}', [MatkulController::class, 'destroy'])->name('matkul.destroy');

        //Ruangan
        Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
        Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
        Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
        Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
        Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

        //Dosen
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
        Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
        Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
        Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
        Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
    });

    // === ADMIN E-KYC ROUTES ===
    Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
        Route::get('/ekyc', [EkycAdminController::class, 'index'])
            ->name('ekyc.index');

        Route::get('/ekyc/{id}', [EkycAdminController::class, 'show'])
            ->name('ekyc.show');

        Route::post('/ekyc/{id}/verify', [EkycAdminController::class, 'verify'])
            ->name('ekyc.verify');
            // atau kalau kamu pakai PUT di form:
            // ->method(['POST', 'PUT']);
    });

        // LANDING PAGE 
        Route::prefix('admin/landing')->name('admin.landing.')->group(function () {
        Route::resource('settings', LandingSettingController::class)->only(['index','store','edit','update']);
        Route::resource('navigation', LandingNavController::class)->except(['show']);
        Route::resource('programs', LandingProgramController::class)->except(['show']);
        Route::resource('footer', LandingFooterController::class)->except(['show']);
        Route::post('footer/reorder', [LandingFooterController::class, 'reorder'])->name('admin.landing.footer.reorder');
        Route::patch('footer/{id}/status', [LandingFooterController::class, 'toggleStatus'])->name('admin.landing.footer.toggleStatus');
    });


        // register
        Route::get('/register-mahasiswa', [StudentRegisterController::class, 'showRegistrationForm'])->name('register.mahasiswa');
        Route::post('/register-mahasiswa', [StudentRegisterController::class,'register']);
        
        // ekyc step 1
        Route::middleware(['auth'])->prefix('ekyc')->group(function () {
        Route::get('step1', [EkycController::class, 'step1'])->name('ekyc.step1');
        Route::post('step1', [EkycController::class, 'storeStep1'])->name('ekyc.storeStep1');

        // ekyc step 2
        Route::get('/ekyc/step2', [EkycController::class, 'step2'])->name('ekyc.step2');
        Route::post('/ekyc/step2', [EkycController::class,'storeStep2'])->name('ekyc.step2.store');
        
        // ekyc  step 3
        Route::get('/ekyc/step3', [EkycController::class, 'showStep3'])->name('ekyc.step3');
        Route::post('/ekyc/step3', [EkycController::class,'storeStep3'])->name('ekyc.step3.store');

        // ekyc  step 4
        Route::get('/ekyc/step4', [EkycController::class, 'showStep4'])->name('ekyc.step4');
        Route::post('/ekyc/step4', [EkycController::class,'storeStep4'])->name('ekyc.step4.store');

        // ekyc step 5
        Route::get('/ekyc/step5', [EkycController::class, 'Step5'])->name('ekyc.step5');

        Route::get('status', [App\Http\Controllers\EkycController::class, 'status'])->name('ekyc.status');

    });

    require __DIR__.'/auth.php';