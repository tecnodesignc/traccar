<?php

namespace Modules\Traccar\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Traccar\Entities\Token;
use Modules\Traccar\Http\Requests\CreateTokenRequest;
use Modules\Traccar\Http\Requests\UpdateTokenRequest;
use Modules\Traccar\Repositories\TokenRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class TokenController extends AdminBaseController
{
    /**
     * @var TokenRepository
     */
    private $token;

    public function __construct(TokenRepository $token)
    {
        parent::__construct();

        $this->token = $token;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$tokens = $this->token->all();

        return view('traccar::admin.tokens.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('traccar::admin.tokens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTokenRequest $request
     * @return Response
     */
    public function store(CreateTokenRequest $request)
    {
        $this->token->create($request->all());

        return redirect()->route('admin.traccar.token.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('traccar::tokens.title.tokens')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Token $token
     * @return Response
     */
    public function edit(Token $token)
    {
        return view('traccar::admin.tokens.edit', compact('token'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Token $token
     * @param  UpdateTokenRequest $request
     * @return Response
     */
    public function update(Token $token, UpdateTokenRequest $request)
    {
        $this->token->update($token, $request->all());

        return redirect()->route('admin.traccar.token.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('traccar::tokens.title.tokens')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Token $token
     * @return Response
     */
    public function destroy(Token $token)
    {
        $this->token->destroy($token);

        return redirect()->route('admin.traccar.token.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('traccar::tokens.title.tokens')]));
    }
}
