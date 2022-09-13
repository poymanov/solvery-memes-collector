<?php

namespace App\Jobs;

use App\Services\Meme\Exceptions\MemeCreateFailedException;
use App\Services\VkParser\Contracts\VkParserServiceContract;
use App\Services\VkParser\Exceptions\RequiredPropertyUndefinedException;
use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceNotFoundException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateParsingStatusException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ParseVkSource implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private VkParsingSourceDto $vkParsingSource;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(VkParsingSourceDto $vkParsingSource)
    {
        $this->vkParsingSource = $vkParsingSource;
    }

    /**
     * @param VkParserServiceContract $vkParserService
     *
     * @return void
     * @throws RequiredPropertyUndefinedException
     * @throws Throwable
     * @throws VkParsingSourceNotFoundException
     * @throws VkParsingSourceUpdateParsingStatusException
     * @throws MemeCreateFailedException
     */
    public function handle(VkParserServiceContract $vkParserService)
    {
        $vkParserService->parseSource($this->vkParsingSource);
    }
}
