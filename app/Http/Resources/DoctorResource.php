<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'phone_number' => $this->doctor->phone_number,
            'password' => $this->password,
            'specialization' => $this->doctor->specialization,
            'license_number' => $this->doctor->license_number,
            'profile_picture' => $this->profile_picture,
        ];
    }
}
