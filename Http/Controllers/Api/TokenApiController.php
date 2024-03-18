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
use Modules\User\Contracts\Authentication;
use Modules\User\Events\UserLoggedIn;
use Modules\User\Transformers\UserLoginTransformer;

class TokenApiController extends Controller
{
    /**
     * @var TokenRepository
     */
    private TokenRepository $token;
    private $user;
    protected $auth;
    public function __construct(TokenRepository $token)
    {
        $this->token = $token;
        $this->auth = app(Authentication::class);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {

            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
            $authService=app(AuthService::class);
            $user = $authService->auth($credentials);

            if (isset($user) && !empty($user)){
                event(new UserLoggedIn($user));
                $response = ["data" =>new UserLoginTransformer($user->load('roles'))];

            }else{
                throw new Exception('Usuario o contraseña incorrecta', '401');
            }


        } catch (Exception $e) {
            Log::Error($e);
            $status = $e->getCode();
            $response = ["errors" => $e->getMessage()];

        }

        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);

    }

}
