<?php

namespace App\Exports;

use App\Models\Artwork;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArtworkExport implements FromQuery, WithMapping, WithHeadings
{

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function query()
    {
        return Artwork::query()->where('userID', $this->user->id);
    }

    /**
    * @var Artwork $artwork
    */
    public function map($artwork): array
    {
        $artwork->stats = $artwork->getStatistics();
        return [
            Storage::url($artwork->URI),
            $artwork->name,
            $artwork->created_at,
            $artwork->updated_at,
            $artwork->description,
            json_encode($artwork->stats),
        ];
    }

    public function headings(): array
    {
        return [
            'Miniatura',
            'Nombre',
            'Fecha de dufusión',
            'Fecha de modificación',
            'Descripción',
            'Estadísticas',
        ];
    }
}

