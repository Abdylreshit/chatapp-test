<?php

namespace App\Actions;

use App\Models\License;

class CreateLicensesAction
{
    public function run($responseData)
    {
        $licenses = $responseData['data'];
        $user = auth()->user();

        foreach($licenses as $license){
            $lic = License::updateOrcreate([
                'user_id' => $user->id,
                'licenseId' => $license['licenseId'],
            ],
            [
                'licenseName' => $license['licenseName'],
                'licenseTo' => $license['licenseTo'],
                'meOwner' => $license['meOwner']
            ]);

            app(CreateMessengersAction::class)->run($lic, $license['messenger']);
        }
    }
}
