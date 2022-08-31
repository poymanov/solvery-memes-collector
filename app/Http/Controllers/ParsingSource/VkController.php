<?php

namespace App\Http\Controllers\ParsingSource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Source\Vk\StoreRequest;
use App\Services\VkParsingSource\Contracts\VkParsingSourceServiceContract;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceCreateFailedException;
use Illuminate\Support\Facades\Log;
use Throwable;

class VkController extends Controller
{
    public function __construct(private readonly VkParsingSourceServiceContract $vkSourceService)
    {
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $vkParsingSources = $this->vkSourceService->findAll();

        return view('sources.vk.index', compact('vkParsingSources'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('sources.vk.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $this->vkSourceService->create($request->get('title'), $request->get('url'));

            return redirect()->route('parsing-source.vk.index')->with('alert.success', 'VK source was created');
        } catch (VkParsingSourceCreateFailedException $e) {
            return redirect()->back()->with('alert.error', $e->getMessage());
        } catch (Throwable $e) {
            Log::error($e);

            return redirect()->route('dashboard')->with('alert.error', 'Something went wrong');
        }
    }
}
