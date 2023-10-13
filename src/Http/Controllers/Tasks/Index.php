<?php

namespace LaravelLiberu\Tasks\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelLiberu\Tasks\Http\Resources\Task;

class Index extends Controller
{
    public function __invoke(Request $request)
    {
        return Task::collection(
            $request->user()->tasks()
                ->skip($request->get('offset'))
                ->take($request->get('paginate'))
                ->pending()
                ->get()
        );
    }
}
