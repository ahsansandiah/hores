<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Tenant extends Model
{
    use SoftDeletes;

    protected $table = "tenant";

    public static function createNewTenant($tenant)
    {
        $tenantModel = self::find($tenant->contact_id);
        if (is_null($tenantModel)) {
            $tenant = new self;
            $tenant->identity_card_type    = $request->type_identity_card;
            $tenant->identity_card_number  = $request->identity_number;
            $tenant->name                  = $request->name;
            $tenant->address               = $request->address;
            $tenant->phone_number          = $request->phone_number;
            $tenant->job                   = $request->job;
            $tenant->save();
        }
    }
}