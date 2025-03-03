<div class="flex justify-center mt-2">
    <ul class="inline-flex space-x-1 text-xs">
        @if ($paginator->onFirstPage())
            <li class="px-2 py-1 text-gray-400 cursor-not-allowed">&lt;</li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" class="px-2 py-1 border rounded hover:bg-gray-200">&lt;</a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="px-2 py-1 text-gray-500">{{ $element }}</li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="px-2 py-1 bg-gray-300 rounded">{{ $page }}</li>
                    @else
                        <li>
                            <a href="{{ $url }}" class="px-2 py-1 border rounded hover:bg-gray-200">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" class="px-2 py-1 border rounded hover:bg-gray-200">&gt;</a>
            </li>
        @else
            <li class="px-2 py-1 text-gray-400 cursor-not-allowed">&gt;</li>
        @endif
    </ul>
</div>
