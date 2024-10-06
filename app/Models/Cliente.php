<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Cliente extends Model
{
    use HasFactory;

    // 1 cliente tiene M servicios
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'clients_services','client_id','service_id');
    }
}
