<?php
/**
 * c
 * @author Ahmed Samir <ahmedsamir732@gmail.com>
 * @package EC2AvailabilityZone
 */
namespace App\Repositories;

use App\Models\AvailabilityZone;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * AvailabilityZoneRepository repository for Availability Zone History.
 * @author Ahmed Samir <ahmedsamir732@gmail.com>
 */
class AvailabilityZoneRepository
{
    /**
     * store stores instanceId & availabilityZone of running ec2 instance.
     * 
     * @author Ahmed Samir <ahmedsamir732@gmail.com>
     * @var instanceId          string
     * @var availabilityZone    string
     * 
     * @return AvailabilityZone
     * @throws UnprocessableEntityHttpException
     */
    public function store(string $instanceId, string $availabilityZone): AvailabilityZone
    {
        $availabilityZone = new AvailabilityZone();
        $availabilityZone->instance_id = $instanceId;
        $availabilityZone->zone = $availabilityZone;
        if ($availabilityZone->save()) {
            return $availabilityZone;
        }

        throw new UnprocessableEntityHttpException('Something wrong happened while saving availability zone!');
    }

    /**
     * get renders availability zone history with dates.
     * @author Ahmed Samir<ahmedsamir732@gmail.com>
     * @var page    int
     * @var perPage int
     * 
     * @return Collection
     */
    public function get(int $page = 1, $perPage = 10)
    {
        return AvailabilityZone::skip(($page - 1)*$perPage)->take($perPage)->get();
    }

    /**
     * count render availability zones total count.
     * @author Ahmed Samir<ahmedsamir732@gmail.com>
     * 
     * @return int
     */
    public function count()
    {
        return AvailabilityZone::count();
    }
}