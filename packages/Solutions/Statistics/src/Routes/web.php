    <?php

    use Illuminate\Support\Facades\Route;
    use Solutions\Statistics\Http\Controllers\StatisticsController;

    Route::prefix('cp/statistics')
        ->middleware(['web', 'auth'])
        ->group(function () {

            Route::get('/', [StatisticsController::class, 'index'])
                ->name('statistics.index')
                ->middleware('perm:statistics.view');

            Route::get('/create', [StatisticsController::class, 'create'])
                ->name('statistics.create')
                ->middleware('perm:statistics.create');

            Route::post('/', [StatisticsController::class, 'store'])
                ->name('statistics.store')
                ->middleware('perm:statistics.create');

            Route::get('/{statistics}/edit', [StatisticsController::class, 'edit'])
                ->name('statistics.edit')
                ->middleware('perm:statistics.edit');

            Route::put('/{statistics}', [StatisticsController::class, 'update'])
                ->name('statistics.update')
                ->middleware('perm:statistics.edit');

            Route::delete('/{statistics}', [StatisticsController::class, 'destroy'])
                ->name('statistics.destroy')
                ->middleware('perm:statistics.delete');

            Route::post('/{statistics}/toggle', [StatisticsController::class, 'toggleStatus'])
                ->name('statistics.toggle')
                ->middleware('perm:statistics.toggle');

            Route::post('/order', [StatisticsController::class, 'updateOrder'])
                ->name('statistics.order')
                ->middleware('perm:statistics.order');
        });
