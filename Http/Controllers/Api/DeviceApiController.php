<?php

namespace Modules\Traccar\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Log;
use Mockery\CountValidator\Exception;
use Modules\Traccar\Http\Requests\CreateTokenRequest;
use Modules\Traccar\Repositories\TokenRepository;
use Modules\Traccar\Services\AuthService;
use Modules\Traccar\Services\DeviceService;
use Modules\Traccar\Transformers\DeviceTransformer;

class DeviceApiController extends Controller
{
    /**
     * @var TokenRepository
     */
    private TokenRepository $token;
    private $user;
    protected DeviceService $device_gps;

    public function __construct(TokenRepository $token, DeviceService $device_gps)
    {
        $this->token = $token;
        $this->device_gps = $device_gps;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTokenRequest $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $token = $this->token->findByAttributes(['user_id' => $user->id]);
            $devices= $this->device_gps->GetDevices(['user_api_hash'=>$token->user_api_hash]);
            $devices = DeviceTransformer::collection($devices[0]->items);
            $response = ["data" => $devices];


        } catch (Exception $e) {
            Log::Error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTokenRequest $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $device_id=$request->input('device_id');
            $token = $this->token->findByAttributes(['user_id' => $user->id]);
            $device= $this->device_gps->GetDevice($device_id,['user_api_hash'=>$token->user_api_hash]);
            dd($device);
            $device = new DeviceTransformer($device[0]->items);
            $response = ["data" => $device];


        } catch (Exception $e) {
            Log::Error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTokenRequest $request
     * @return JsonResponse
     */
    public function command(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $token = $this->token->findByAttributes(['user_id' => $user->id]);
            $command=$request->input('command');
            $device_id=$request->input('device_id');
            $response= $this->device_gps->SetCommand($device_id,$command,['user_api_hash'=>$token->user_api_hash]);
            $response = ["data" => $response];


        } catch (Exception $e) {
            Log::Error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTokenRequest $request
     * @return JsonResponse
     */
    public function historic(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $token = $this->token->findByAttributes(['user_id' => $user->id]);
            $devices= $this->device_gps->GetDevices(['user_api_hash'=>$token->user_api_hash]);
            $devices = DeviceTransformer::collection($devices[0]->items);
            $response = ["data" => $devices];


        } catch (Exception $e) {
            Log::Error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);

    }

}
