<?php
namespace App\Filament\Resources\IncomeResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Income;

/**
 * @property Income $resource
 */
class IncomeTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'icon' => $this->icon,
        ];
    }
}
