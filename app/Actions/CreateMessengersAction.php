<?php

namespace App\Actions;

use App\Models\Messenger;

class CreateMessengersAction
{
    public function run($license, $messengers)
    {
        foreach($messengers as $messenger){
            Messenger::updateOrCreate(
                [
                    'license_id' => $license->id,
                    'type' => $messenger['type'],
                ],
                [
                    'name' => $messenger['name']
                ]
            );
        }
    }
}
