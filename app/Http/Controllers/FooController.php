<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use app\Repositories\FooRepository;
use Illuminate\Http\Request;

class FooController extends Controller {

	private $repository;

    public function __construct(FooRepository $repository)
    {
        $this->repository = $repository;
    }

    public function foo()
    {
        $repository = new \App\Repositories\FooRepository();

        return $repository->get();
    }

}
