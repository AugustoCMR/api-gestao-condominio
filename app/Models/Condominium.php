<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'uuid',
    'name',
    'cnpj',
    'address',
    'phone',
    'complement',
    'neighborhood',
    'city',
    'state',
    'zip_code',
    'email'
])]
#[Hidden(['id'])]
#[Table('condominiums')]
class Condominium extends Model
{
    use HasUuids;

    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}
