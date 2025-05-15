<?php
namespace App\Filament\Resources\IncomeResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\IncomeResource;
use App\Filament\Resources\IncomeResource\Api\Requests\CreateIncomeRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = IncomeResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Income
     *
     * @param CreateIncomeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateIncomeRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}