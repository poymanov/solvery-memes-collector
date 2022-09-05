<?php

namespace App\Console\Commands\Parsing;

use App\Jobs\ParseVkSource;
use App\Services\VkParsingSource\VkParsingSourceService;
use Illuminate\Console\Command;
use Psy\Command\ExitCommand;

class VkSource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parsing:vk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add VK parsing source to queue';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $vkParsingSourceService = app(VkParsingSourceService::class);
        $vkParsingSources = $vkParsingSourceService->findAll();

        foreach ($vkParsingSources as $vkParsingSource) {
            ParseVkSource::dispatch($vkParsingSource);
        }

        return ExitCommand::SUCCESS;
    }
}
