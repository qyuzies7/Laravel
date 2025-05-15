<?php

namespace App\Filament\Resources\IncomeResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\IncomeResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\IncomeResource\Api\Transformers\IncomeTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = IncomeResource::class;


    /**
     * Show Income
     *
     * @param Request $request
     * @return IncomeTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new IncomeTransformer($query);
    }
}
