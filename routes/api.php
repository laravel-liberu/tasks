<?php

use Illuminate\Support\Facades\Route;
use LaravelLiberu\Tasks\Http\Controllers\Tasks\Count;
use LaravelLiberu\Tasks\Http\Controllers\Tasks\Create;
use LaravelLiberu\Tasks\Http\Controllers\Tasks\Destroy;
use LaravelLiberu\Tasks\Http\Controllers\Tasks\Edit;
use LaravelLiberu\Tasks\Http\Controllers\Tasks\ExportExcel;
use LaravelLiberu\Tasks\Http\Controllers\Tasks\Index;
use LaravelLiberu\Tasks\Http\Controllers\Tasks\InitTable;
use LaravelLiberu\Tasks\Http\Controllers\Tasks\Store;
use LaravelLiberu\Tasks\Http\Controllers\Tasks\TableData;
use LaravelLiberu\Tasks\Http\Controllers\Tasks\Update;
use LaravelLiberu\Tasks\Http\Controllers\Tasks\Users;

Route::middleware(['api', 'auth', 'core'])
    ->prefix('api/tasks')
    ->as('tasks.')
    ->group(function () {
        Route::get('create', Create::class)->name('create');
        Route::post('', Store::class)->name('store');
        Route::get('{task}/edit', Edit::class)->name('edit');

        Route::patch('{task}', Update::class)->name('update');

        Route::delete('{task}', Destroy::class)->name('destroy');

        Route::get('initTable', InitTable::class)->name('initTable');
        Route::get('tableData', TableData::class)->name('tableData');
        Route::get('exportExcel', ExportExcel::class)->name('exportExcel');

        Route::get('count', Count::class)->name('count');
        Route::get('', Index::class)->name('index');

        Route::get('users', Users::class)->name('users');
    });
