@php
    /**
     * @var \Confetti\Helpers\ContentStore $contentStore
     * @var \Confetti\Helpers\ComponentStore $componentStore
     * @var \Confetti\Helpers\ComponentEntity[] $menuComponents
     * @var string $currentContentId
     */
    $menuComponents = $componentStore->whereType('section');
    $mainItems = [];
    $subItems = [];
    // Separate main items from sub items
    foreach ($menuComponents as $component) {
        $parts = explode('/', $component->key);
        $mainKey = "$parts[0]/$parts[1]/$parts[2]";
        if ($mainKey === $component->key) {
            $mainItems[] = $component;
        } else {
            $subItems[$mainKey][] = $component;
        }
    }
@endphp
<div class="py-4 text-gray-500 dark:text-gray-400">
    <ul class="mt-6">
        @foreach($mainItems as $mainComponent)
            <li class="relative px-3 py-3">
                @if(!key_exists($mainComponent->key, $subItems))
                    {{-- @todo component key by id --}}
                    @php($isCurrent = $mainComponent->key === $currentContentId)
                        @if($isCurrent)
                            <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-primary-600"
                                aria-hidden="true"></span>
                        @endif
                    <app-button full-width variant="clear" href="/admin{{ $mainComponent->key }}" anchor>
                        <span class="ml-4">
                            {{ $mainComponent->getDecoration('label')['value'] }}
                        </span>
                    </app-button>
                @else
                    <app-button @click="togglePagesMenu" full-width variant="clear" anchor>
                        <div class="flex">
                            <span class="ml-4">
                                {{ $mainComponent->getDecoration('label')['value'] }}
                            </span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                    </app-button>
                    <div v-auto-animate>
                        <ul
                            v-if="isPagesMenuOpen"
                            class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        >
                            @foreach($subItems[$mainComponent->key] as $component)
                                <li class="pl-5 pr-1 py-1 hover:text-gray-800 dark:hover:text-gray-200">
                                    <app-button full-width variant="clear" href="/admin{{ $component->key }}" anchor>
                                        {{ $component->getDecoration('label')['value'] }}
                                    </app-button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</div>
