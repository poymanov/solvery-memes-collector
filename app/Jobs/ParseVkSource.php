<?php

namespace App\Jobs;

use App\Enums\ParsingStatusEnum;
use App\Services\VkParsingSource\Contracts\VkParsingSourceServiceContract;
use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
     * Execute the job.
     *
     * @return void
     */
    public function handle(VkParsingSourceServiceContract $vkParsingSourceService)
    {
        $vkParsingSourceService->updateParsingStatus($this->vkParsingSource->id, ParsingStatusEnum::SUCCESS);

        Log::info($this->vkParsingSource->url);
    }
}
