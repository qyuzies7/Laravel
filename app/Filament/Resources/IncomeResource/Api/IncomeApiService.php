<?php
namespace App\Filament\Resources\IncomeResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\IncomeResource;
use Illuminate\Routing\Router;


class IncomeApiService extends ApiService
{
    protected static string | null $resource = IncomeResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
