<?php

namespace Modules\Traccar\Services;


use http\Params;
use Modules\User\Repositories\UserRepository;

class DeviceService extends Connection
{

    /**
     * @var UserRepository
     */
    private UserRepository $user;


    public function GetDevices($params=[])
    {
        $this->params($params);
        $device = $this->get('/get_devices');

        return $device;

    }

    public function GetDevice($device_id, $params)
    {
        $this->params(array_merge(['device_id'=>$device_id],$params));
        return $this->get('/edit_device_data');

    }

    public function SetCommand($device_id,$command,$params=[],$type='custom')
    {
        $this->params($params);

        $input=[
            'device_id'=>$device_id,
            'type'=>$type,
            'data'=>$command
        ];
        $device = $this->post($input,'/send_gprs_command');

        return $device;

    }

}
