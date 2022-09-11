<?php

namespace App\Jobs;

use App\Enums\ParsingStatusEnum;
use App\Services\VkParser\Contracts\VkParserServiceContract;
use App\Services\VkParsingSource\Contracts\VkParsingSourceServiceContract;
use App\Services\VkParsingSource\Dtos\VkParsingSourceDto;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceNotFoundException;
use App\Services\VkParsingSource\Exceptions\VkParsingSourceUpdateParsingStatusException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
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
     * Execute the job.
     *
     * @param VkParsingSourceServiceContract $vkParsingSourceService
     * @param VkParserServiceContract        $vkParserService
     *
     * @return void
     * @throws VkParsingSourceNotFoundException
     * @throws VkParsingSourceUpdateParsingStatusException
     * @throws Throwable
     */
    public function handle(VkParsingSourceServiceContract $vkParsingSourceService, VkParserServiceContract $vkParserService)
    {
        try {
            $posts = $vkParserService->getPostsByUrl($this->vkParsingSource->url);

            foreach ($posts as $post) {
                Log::info($post->text ?? (string) $post->id);
            }

            $vkParsingSourceService->updateParsingStatus($this->vkParsingSource->id, ParsingStatusEnum::SUCCESS);
        } catch (Throwable $e) {
            $vkParsingSourceService->updateParsingStatus($this->vkParsingSource->id, ParsingStatusEnum::FAILED);

            Log::error('VK Parser (' . $this->vkParsingSource->url . '): ' . $e->getMessage());
            throw new $e();
        }
    }
}
