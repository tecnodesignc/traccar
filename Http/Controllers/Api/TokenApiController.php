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

class TokenApiController extends Controller
{
    /**
     * @var TokenRepository
     */
    private TokenRepository $token;
    private $user;

    public function __construct(TokenRepository $token)
    {
        $this->token = $token;
        $this->user = Auth::user();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTokenRequest $request
     * @return JsonResponse
     */
    public function store(CreateTokenRequest $request): JsonResponse
    {
        try {

            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
            $authService=app(AuthService::class);
            $token = $authService->setToken($credentials);

            if ($token->status){
                $response = ["data" => $token->user_api_hash];
            }else{
                throw new Exception('Uuario o contraseña incorrecta', '401');
            }


        } catch (Exception $e) {

            Log::Error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];

        }

        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);

    }

}
