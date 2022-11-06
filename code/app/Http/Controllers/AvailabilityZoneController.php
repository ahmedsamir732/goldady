<?php
/**
 * AvailabilityZoneController
 * @author Ahmed Samir <ahmedsamir732@gmail.com>
 * @package EC2AvailabilityZone
 */
namespace App\Http\Controllers;

use App\Repositories\AvailabilityZoneRepository;
use App\Libraries\EC2MetaData;
use App\Resources\AvailabilityZoneResource;
use Illuminate\Http\Request;

/**
 * AvailabilityZoneController discover and render the running ec2 availability zone.
 * @author Ahmed Samir <ahmedsamir732@gmail.com>
 */
class AvailabilityZoneController extends Controller
{
    /**
     * store discover and store ec2 avaiability zone
     * @var Request $request holds the http request data
     * 
     * @return JsonRespnse
     */
    public function store(Request $request)
    {
        $status = (new AvailabilityZoneRepository)->store(
            EC2MetaData::getInstanceID(),
            EC2MetaData::getAvailabilityZone(),
        );

        return ['status' => $status];
    }

    /**
     * render ec2 avaiability zone
     * @var Request $request holds the http request data
     * 
     * @return JsonRespnse
     */
    public function history(Request $request)
    {
        $repository = new AvailabilityZoneRepository;
        $list = $repository->get($request->page??1, $request->per_page??10);
        $data['total'] = $repository->count();
        $data['count'] = $list->count();
        $data['data']  = AvailabilityZoneResource::collection($list);
        
        return $data;
    }
}
