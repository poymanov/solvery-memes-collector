<?php

namespace App\Http\Controllers;

use App\Services\Meme\Contracts\MemeServiceContract;

class MemeController extends Controller
{
    public function __construct(private readonly MemeServiceContract $memeService)
    {
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $memes = $this->memeService->findAll();

        return view('meme.index', compact('memes'));
    }
}
