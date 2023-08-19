<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\CommonQuastions\QuastionsCollection;
use App\Models\CommonQuestion;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CommonQuastionsController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        $paginate = $request->pageLength ?? 10 ;
        $complients = CommonQuestion::Active()->paginate($paginate);
        return new QuastionsCollection($complients);
    }
}
