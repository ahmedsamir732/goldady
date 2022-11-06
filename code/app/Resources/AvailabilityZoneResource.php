<?php
/**
 * c
 * @author Ahmed Samir <ahmedsamir732@gmail.com>
 * @package EC2AvailabilityZone
 */
namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * AvailabilityZoneResource resource for Availability Zone History.
 * @author Ahmed Samir <ahmedsamir732@gmail.com>
 */
class AvailabilityZoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        $data = [
            'instance_id' => $this->instance_id,
            'availability_zone' => $this->zone,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        return $data;
    }
}