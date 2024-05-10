<?php

namespace Modules\Traccar\Services;


use http\Params;
use Modules\User\Repositories\UserRepository;

class OsmandService extends Connection
{

    /**
     * @param $params['id'=>'imei','lat'=>4.441939,'lon'=>-75.233274,'timestamp'=>1714486957,'cell'=>'208,10,12345,67890,50','wifi'=>'00:11:22:33:44:55,-70','location'=>null,'speed'=>null,'bearing'=>null,'heading'=>null,'altitude'=>null,'accuracy'=>null,'hdop'=>null,'batt'=>null,'driverUniqueId'=>null,'charge'=>null]
     * @return \Exception|mixed
     */
    public function SetRequest($params=[])
    {
        try {
            $response = Http::get(config('encore::traccar.url').':'.config('encore::traccar.osmand.port'), $this->params);
            $statusCode = $response->status();
            $responseBody = json_decode($response->getBody());
            if ($statusCode == 401 || $statusCode == 400) throw new \Exception($responseBody->message);
            return $responseBody;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function GetDevice($device_id, $params)
    {
        $this->params(array_merge(['device_id'=>$device_id],$params));
        return $this->get('/edit_device_data');

    }


}
