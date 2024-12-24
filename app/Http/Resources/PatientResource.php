<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
$data=parent::toArray($request);

dd($data);

    return [    

'id' => $data['id'],
        'name' => $data['name'],
        'email' => $data['email'],
        'type' => $data['type'],
        'country' => $data['country'],
        'gender' => $data['gender'],
        'date_of_birth' => $data['date_of_birth'],
        'profile_picture' => $data['profile_picture'],


    ];
    }
}
