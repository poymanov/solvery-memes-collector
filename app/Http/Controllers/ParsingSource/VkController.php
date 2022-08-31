<?php

namespace App\Http\Controllers\ParsingSource;

use App\Http\Controllers\Controller;
use App\Http\Requests\Source\Vk\StoreRequest;
use App\Http\Requests\Source\Vk\UpdateRequest;
use App\Models\VkParsingSource;
use App\Services\VkParsingSource\Contracts\VkParsingSourceServiceContract;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceCreateFailedException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceNotFoundException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateFailedException;
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
     * @param VkParsingSource $vk
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(VkParsingSource $vk)
    {
        try {
            $vkParsingSource = $this->vkSourceService->findOneById($vk->id);

            return view('sources.vk.edit', compact('vkParsingSource'));
        } catch (VkParsingSourceNotFoundException $e) {
            return redirect()->back()->with('alert.error', $e->getMessage());
        } catch (Throwable $e) {
            Log::error($e);

            return redirect()->route('dashboard')->with('alert.error', 'Something went wrong');
        }
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

    /**
     * @param VkParsingSource $vk
     * @param UpdateRequest   $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VkParsingSource $vk, UpdateRequest $request)
    {
        try {
            $this->vkSourceService->update($vk->id, $request->get('title'), $request->get('url'));

            return redirect()->route('parsing-source.vk.index')->with('alert.success', 'VK source was updated');
        } catch (VkParsingSourceNotFoundException | VkParsingSourceUpdateFailedException $e) {
            return redirect()->back()->with('alert.error', $e->getMessage());
        } catch (Throwable $e) {
            Log::error($e);

            return redirect()->route('dashboard')->with('alert.error', 'Something went wrong');
        }
    }
}
