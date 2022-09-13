@if ($status === \App\Enums\ParsingStatusEnum::NOT_PARSED)
    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $status->title() }}</span>
@elseif ($status === \App\Enums\ParsingStatusEnum::SUCCESS)
    <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{ $status->title() }}</span>
@elseif ($status === \App\Enums\ParsingStatusEnum::FAILED)
    <span @if($description) title="{{ $description }}" @endif class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">{{ $status->title() }}</span>
@endif
