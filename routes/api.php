<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Laravue\Faker;
use \App\Laravue\JsonResponse;
use \App\Laravue\Acl;
use App\Http\Controllers\Api\Mapa2Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function() {
    // print
    Route::get('print-surat-tugas', 'PrintController@index');
    Route::get('print-semua-module', 'PrintController@printMaster');
    Route::get('print-modules', 'PrintController@printModules');
    // Jadwal Routes
    Route::apiResource('jadwaltest', 'JadwalController');
    Route::apiResource('tamatan', 'TamatanController');
    Route::get('find-nik', 'UserController@findNik');
    Route::post('auth/login', 'AuthController@login');
    // APL 02 / Pendaftaran Routes
    Route::post('uji-kompetensi-daftar', 'UjiKompController@store');
    Route::get('skema-get', 'SkemaController@index');
    Route::get('unit-kompetensi-get', 'SkemaController@indexUnit');
    Route::get('tuk-get', 'TukController@index');
    Route::get('jadwal-get', 'JadwalController@index');
    Route::post('uji-komp-post', 'UjiKompController@store');
    Route::post('new-user-uji', 'UjiKompController@newUser');
    Route::post('check-user-uji', 'UjiKompController@checkUser');
    Route::get('uji-komp-get', 'UjiKompController@index');
    Route::get('skema-kategori-get', 'AsesmenKategoriController@index');

    Route::get('mst-ia02-get-old', 'PerangkatController@indexIa02Old');
    Route::get('mst-ia02-get-detail', 'PerangkatController@indexIa02Detail');
    Route::get('mst-ia02-get', 'PerangkatController@indexIa02');
    Route::get('mst-ia03-get', 'PerangkatController@indexIa03');
    Route::get('mst-ia06-get', 'PerangkatController@indexIa06');
    Route::get('mst-ia05-get', 'PerangkatController@indexIa05');
    Route::get('mst-ia07-get', 'PerangkatController@indexIa07');
    Route::get('mst-ia-11-get', 'PerangkatController@indexIa11');
    Route::get('mst-ak-03-get', 'PerangkatController@indexAk03');
    Route::get('mst-ak-04-get', 'PerangkatController@indexAk04');

    //previewFR
    Route::get('preview/ia-06/{id}', 'UjiKompController@previewIa06');
    Route::get('preview/ia-11/{id}', 'UjiKompController@previewIa11');
    Route::get('preview/ak-03/{id}', 'UjiKompController@previewAk03');
    Route::get('preview/ak-04/{id}', 'UjiKompController@previewAk04');

    //detail FR;
    Route::get('soal/ia05/ia07/{id}', 'UjiKompController@getSoalIa05AndIa07');
    Route::get('detail/jadwal-asesmen/{id}', 'UjiKompController@showJadwalAsesmen');
    Route::get('jumlah-skema', 'SkemaController@countSkema');
    Route::get('detail/asesor', 'UjiKompController@showAsesor');
    Route::get('detail/signature', 'UjiKompController@showSignature');
    Route::get('detail/preview/{id}', 'UjiKompController@showPreview');
    Route::get('detail/indexPreview/{id}', 'UjiKompController@indexPreview');
    Route::get('detail/apl-01/{id}', 'UjiKompController@showApl01');
    Route::get('detail/apl-02/{id}', 'UjiKompController@showApl02');
    Route::get('detail/mapa-02/{id}', 'UjiKompController@showMapa02');
    Route::get('detail/ia-01/{id}', 'UjiKompController@showIa01');
    Route::get('detail/ia-02/{id}', 'UjiKompController@showIa02');
    Route::get('detail/ia-03/{id}', 'UjiKompController@showIa03');
    Route::get('detail/ia-06/{id}', 'UjiKompController@showIa06');
    Route::get('detail/ia-05/{id}', 'UjiKompController@showIa05');
    Route::get('detail/ia-07/{id}', 'UjiKompController@showIa07');
    Route::get('detail/ia-11/{id}', 'UjiKompController@showIa11');
    Route::get('detail/ak-01/{id}', 'UjiKompController@showAk01');
    Route::get('detail/ak-02/{id}', 'UjiKompController@showAk02');
    Route::get('detail/ak-03/{id}', 'UjiKompController@showAk03');
    Route::get('detail/ak-04/{id}', 'UjiKompController@showAk04');
    Route::get('detail/ak-05', 'UjiKompController@showAk05');
    // Route::get('detail/ak-05', 'UjiKompController@showAk05');
    Route::get('detail/va/{id}', 'UjiKompController@showVa');
    Route::get('ak-06/{id}', 'UjiKompController@showAk06');
    Route::get('trx-mapa-02/{id}', 'UjiKompController@showMapa02');

    Route::apiResource('dashboard', 'DashboardController');

    // IA 02
    Route::post('mst-ia02-update', 'PerangkatController@editIa02');

    // TUK Routes
    Route::apiResource('tuk', 'TukController');
    Route::post('tuk/update', 'TukController@update');

    // KKNI jRoutes
    Route::apiResource('kkni', 'KkniController');
    Route::post('kkni/update', 'KkniController@update');

    // DUDI Routes
    Route::apiResource('dudi', 'DudiController');
    Route::post('dudi/update', 'DudiController@update');

    // Assesor Routes
    Route::apiResource('assesor', 'AssesorController');
    Route::post('assesor/update', 'AssesorController@update');

    // Article Routes
    Route::apiResource('article', 'ArticleController');
    Route::post('article/update', 'ArticleController@update');
    Route::get('article/detail/{slug}', 'ArticleController@slug');

    Route::post('new-mst-ia-02-detail', 'PerangkatController@storeIa02Detail');
    Route::post('del-mst-ia-02-detail', 'PerangkatController@deleteIa02Detail');
    Route::post('uji-komp-ia-02', 'UjiKompController@storeIa02');
    Route::get('uji-komp-ia-02-detail', 'UjiKompController@indexIa02Detail');
    Route::get('sendEmail', 'SendEmailController@index');
    Route::post('uji-komp-ak-05', 'UjiKompController@storeAk05');


    Route::group(['middleware' => 'auth:sanctum'], function () {

        //Post MST FR
        Route::post('new-mst-ia-02', 'PerangkatController@storeIa02');
        Route::post('new-mst-ia-03', 'PerangkatController@storeIa03');
        Route::post('new-mst-ia-05', 'PerangkatController@storeIa05');
        Route::post('detail-mst-ia-05', 'PerangkatController@storeIa05Detail');
        Route::post('new-mst-ia-06', 'PerangkatController@storeIa06');
        Route::post('new-mst-ia-07', 'PerangkatController@storeIa07');
        Route::apiResource('mapa2','Mapa2Controller');

        //Delete MST FR
        Route::post('del-mst-ia-02', 'PerangkatController@deleteIa02');
        Route::post('del-mst-ia-03', 'PerangkatController@deleteIa03');
        Route::post('del-mst-ia-05', 'PerangkatController@deleteIa05');
        Route::post('del-mst-ia-06', 'PerangkatController@deleteIa06');
        Route::post('del-mst-ia-07', 'PerangkatController@deleteIa07');
        Route::post('del-mapa2','Mapa2Controller@destroy');
        
        //Post FR
        Route::post('uji-komp-apl-01', 'UjiKompController@submitApl01');
        Route::post('uji-komp-apl-02', 'UjiKompController@submitApl02');
        Route::post('uji-komp-ia-01', 'UjiKompController@storeIa01');
        // Route::post('uji-komp-ia-02', 'UjiKompController@storeIa02');
        Route::post('uji-komp-ia-02-nilai', 'UjiKompController@penilaianIa02');
        Route::post('uji-komp-ia-03', 'UjiKompController@storeIa03');
        Route::post('uji-komp-ia-03-nilai', 'UjiKompController@penilaianIa03');
        Route::post('uji-komp-ia-05', 'UjiKompController@storeIa05');
        Route::post('uji-komp-ia-05-nilai', 'UjiKompController@penilaianIa05');
        Route::post('uji-komp-ia-06', 'UjiKompController@storeIa06');
        Route::post('uji-komp-ia-06-nilai', 'UjiKompController@penilaianIa06');
        Route::post('uji-komp-ia-07', 'UjiKompController@storeIa07');
        Route::post('uji-komp-ia-07-nilai', 'UjiKompController@penilaianIa07');
        Route::post('uji-komp-ia-11', 'UjiKompController@storeIa11');
        Route::post('uji-komp-ak-01', 'UjiKompController@storeAk01');
        Route::post('uji-komp-ak-01-asesi', 'UjiKompController@storeAk01Asesi');
        Route::post('uji-komp-ak-03', 'UjiKompController@storeAk03');
        Route::post('uji-komp-ak-02', 'UjiKompController@storeAk02');
        Route::post('uji-komp-ak-04', 'UjiKompController@storeAk04');
        // Route::post('uji-komp-ak-05', 'UjiKompController@storeAk05');
        Route::post('uji-komp-ak-06', 'UjiKompController@storeAk06');
        Route::post('uji-komp-mapa-02','UjiKompController@storeMapa02');
        Route::post('uji-komp-va', 'UjiKompController@storeVa');
        // Jadwal Routes
        Route::apiResource('jadwal', 'JadwalController');

        // Uji Routes
        Route::apiResource('uji', 'UjiKompController');

        // Perangkat Routes
        Route::apiResource('perangkat-asesmen', 'PerangkatAsesmenController');
        Route::get('detail-perangkat-asesmen', 'PerangkatAsesmenController@indexDetail');
        Route::post('detail-perangkat-asesmen', 'PerangkatAsesmenController@storeDetail');
        Route::get('jenis-perangkat', 'PerangkatAsesmenController@indexJenis');

        // APL 02 / Pendaftaran Routes
        Route::apiResource('uji-kompetensi', 'UjiKompController');

        // Pemegang Sertifikat
        Route::apiResource('pemegang-sertifikat', 'PemegangSertifikatController');
        Route::post('pemegang-sertifikat-edit', 'PemegangSertifikatController@update');


        // Skema
        Route::apiResource('skema/kategori', 'AsesmenKategoriController');
        Route::apiResource('skema', 'SkemaController');
        Route::post('skema/upload/unit', 'SkemaController@uploadUnit');
        Route::post('skema/add/unit', 'SkemaController@storeUnit');
        Route::post('skema/upload/elemen', 'SkemaController@uploadElemenUnit');
        Route::post('skema/upload/kuk', 'SkemaController@uploadKuk');

        Route::post('skema/update/unit', 'SkemaController@updateUnit');
        Route::post('skema/update/elemen', 'SkemaController@updateElemenUnit');
        Route::post('skema/update/kuk', 'SkemaController@updateKuk');
        Route::delete('skema/unit/{id}', 'SkemaController@destroyUnit');
        Route::delete('skema/elemen/{id}', 'SkemaController@destroyElemen');
        Route::delete('skema/kuk/{id}', 'SkemaController@destroyKuk');


        // Auth routes
        Route::get('auth/user', 'AuthController@user');
        Route::post('auth/logout', 'AuthController@logout');

        Route::get('/user', function (Request $request) {
            return new UserResource($request->user());
        });

        // Api resource routes
        Route::apiResource('roles', 'RoleController')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);
        Route::apiResource('users', 'UserController');
        Route::apiResource('permissions', 'PermissionController')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);

        Route::put('update-password/{user}', 'UserController@changePassword');
        Route::post('update-role', 'UserController@setRole');
        Route::post('user/save-signature', 'UserController@addSignature');

        // Custom routes
        Route::put('users/{user}', 'UserController@update');
        Route::get('users/{user}/permissions', 'UserController@permissions')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);
        Route::put('users/{user}/permissions', 'UserController@updatePermissions')->middleware('permission:' .Acl::PERMISSION_PERMISSION_MANAGE);
        Route::get('roles/{role}/permissions', 'RoleController@permissions')->middleware('permission:' . Acl::PERMISSION_PERMISSION_MANAGE);
    });
});

// Fake APIs
Route::get('/table/list', function () {
    $rowsNumber = mt_rand(20, 30);
    $data = [];
    for ($rowIndex = 0; $rowIndex < $rowsNumber; $rowIndex++) {
        $row = [
            'author' => Faker::randomString(mt_rand(5, 10)),
            'display_time' => Faker::randomDateTime()->format('Y-m-d H:i:s'),
            'id' => mt_rand(100000, 100000000),
            'pageviews' => mt_rand(100, 10000),
            'status' => Faker::randomInArray(['deleted', 'published', 'draft']),
            'title' => Faker::randomString(mt_rand(20, 50)),
        ];

        $data[] = $row;
    }

    return response()->json(new JsonResponse(['items' => $data]));
});

Route::get('/orders', function () {
    $rowsNumber = 8;
    $data = [];
    for ($rowIndex = 0; $rowIndex < $rowsNumber; $rowIndex++) {
        $row = [
            'order_no' => 'LARAVUE' . mt_rand(1000000, 9999999),
            'price' => mt_rand(10000, 999999),
            'status' => Faker::randomInArray(['success', 'pending']),
        ];

        $data[] = $row;
    }

    return response()->json(new JsonResponse(['items' => $data]));
});

Route::get('/articles', function () {
    $rowsNumber = 10;
    $data = [];
    for ($rowIndex = 0; $rowIndex < $rowsNumber; $rowIndex++) {
        $row = [
            'id' => mt_rand(100, 10000),
            'display_time' => Faker::randomDateTime()->format('Y-m-d H:i:s'),
            'title' => Faker::randomString(mt_rand(3, 10)),
            'author' => Faker::randomString(mt_rand(5, 10)),
            'comment_disabled' => Faker::randomBoolean(),
            'content' => Faker::randomString(mt_rand(10, 20)),
            'status' => Faker::randomInArray(['deleted', 'published', 'draft']),
            'forecast' => mt_rand(100, 9999) / 100,
            'image_uri' => 'https://cdn.siasat.com/wp-content/uploads/2019/03/online-store.png',
            'importance' => mt_rand(1, 3),
            'pageviews' => mt_rand(10000, 999999),
            'reviewer' => Faker::randomString(mt_rand(5, 10)),
            'timestamp' => Faker::randomDateTime()->getTimestamp(),
            'type' => Faker::randomInArray(['US', 'VI', 'JA']),

        ];

        $data[] = $row;
    }

    return response()->json(new JsonResponse(['items' => $data, 'total' => mt_rand(1000, 10000)]));
});

// Route::get('articles/{id}', function ($id) {
//     // get article
//     $article = [
//         'id' => $id,
//         'display_time' => Faker::randomDateTime()->format('Y-m-d H:i:s'),
//         'title' => Faker::randomString(mt_rand(20, 50)),
//         'author' => Faker::randomString(mt_rand(5, 10)),
//         'comment_disabled' => Faker::randomBoolean(),
//         'content' => Faker::randomString(mt_rand(100, 300)),
//         'content_short' => Faker::randomString(mt_rand(30, 50)),
//         'status' => Faker::randomInArray(['deleted', 'published', 'draft']),
//         'forecast' => mt_rand(100, 9999) / 100,
//         'image_uri' => 'https://via.placeholder.com/400x300',
//         'importance' => mt_rand(1, 3),
//         'pageviews' => mt_rand(10000, 999999),
//         'reviewer' => Faker::randomString(mt_rand(5, 10)),
//         'timestamp' => Faker::randomDateTime()->getTimestamp(),
//         'type' => Faker::randomInArray(['US', 'VI', 'JA']),

//     ];

//     return response()->json(new JsonResponse($article));
// });

// Route::get('articles/{id}/pageviews', function ($id) {
//     $pageviews = [
//         'PC' => mt_rand(10000, 999999),
//         'Mobile' => mt_rand(10000, 999999),
//         'iOS' => mt_rand(10000, 999999),
//         'android' => mt_rand(10000, 999999),
//     ];
//     $data = [];
//     foreach ($pageviews as $device => $pageview) {
//         $data[] = [
//             'key' => $device,
//             'pv' => $pageview,
//         ];
//     }

//     return response()->json(new JsonResponse(['pvData' => $data]));
// });
