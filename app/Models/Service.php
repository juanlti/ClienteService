<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Service extends Model
{
    use HasFactory;

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'clients_services','client_id','service_id');
    }
}
