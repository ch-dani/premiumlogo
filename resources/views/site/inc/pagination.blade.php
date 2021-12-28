@if($paginator->hasPages())
    <ul class="module__pagination">
        @if($paginator->onFirstPage())
            <li>
                <a href="#" class="prev pagination-arrow">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.38742 2.15001L3.53742 7.00001L8.38742 11.85C8.50314 11.9657 8.59494 12.1031 8.65757 12.2543C8.7202 12.4055 8.75244 12.5676 8.75244 12.7313C8.75244 12.8949 8.7202 13.057 8.65757 13.2082C8.59494 13.3594 8.50314 13.4968 8.38742 13.6125C8.27169 13.7282 8.1343 13.82 7.98309 13.8827C7.83189 13.9453 7.66983 13.9775 7.50617 13.9775C7.3425 13.9775 7.18044 13.9453 7.02924 13.8827C6.87803 13.82 6.74064 13.7282 6.62492 13.6125L0.887416 7.87501C0.399916 7.38751 0.399916 6.60001 0.887416 6.11251L6.62492 0.375015C6.74056 0.259136 6.87792 0.167201 7.02914 0.104475C7.18035 0.0417479 7.34246 0.00946033 7.50617 0.00946034C7.66988 0.00946035 7.83198 0.041748 7.9832 0.104475C8.13441 0.167201 8.27177 0.259136 8.38742 0.375015C8.86242 0.862515 8.87492 1.66251 8.38742 2.15001Z"
                              fill="#363636"></path>
                    </svg>
                </a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" class="prev pagination-arrow">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.38742 2.15001L3.53742 7.00001L8.38742 11.85C8.50314 11.9657 8.59494 12.1031 8.65757 12.2543C8.7202 12.4055 8.75244 12.5676 8.75244 12.7313C8.75244 12.8949 8.7202 13.057 8.65757 13.2082C8.59494 13.3594 8.50314 13.4968 8.38742 13.6125C8.27169 13.7282 8.1343 13.82 7.98309 13.8827C7.83189 13.9453 7.66983 13.9775 7.50617 13.9775C7.3425 13.9775 7.18044 13.9453 7.02924 13.8827C6.87803 13.82 6.74064 13.7282 6.62492 13.6125L0.887416 7.87501C0.399916 7.38751 0.399916 6.60001 0.887416 6.11251L6.62492 0.375015C6.74056 0.259136 6.87792 0.167201 7.02914 0.104475C7.18035 0.0417479 7.34246 0.00946033 7.50617 0.00946034C7.66988 0.00946035 7.83198 0.041748 7.9832 0.104475C8.13441 0.167201 8.27177 0.259136 8.38742 0.375015C8.86242 0.862515 8.87492 1.66251 8.38742 2.15001Z"
                              fill="#363636"></path>
                    </svg>
                </a>
            </li>
        @endif

        @if($paginator->currentPage() > 3)
            <li>
                <a href="{{ $paginator->url(1) }}" class="page">1</a>
            </li>
        @endif
        @if($paginator->currentPage() > 4)
            <li>
                <a href="#" class="ellipsis">...</a>
            </li>
        @endif

        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if($i == $paginator->currentPage())
                    <li>
                        <a href="#" class="page active">{{ $i }}</a>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->url($i) }}" class="page">{{ $i }}</a>
                    </li>
                @endif
            @endif
        @endforeach

        @if($paginator->currentPage() < $paginator->lastPage() -3)
            <li>
                <a href="#" class="ellipsis">...</a>
            </li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() -2)
            <li class="page-item hidden-xs">
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">
                    {{ $paginator->lastPage() }}
                </a>
            </li>
        @endif

        @if($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" class="next pagination-arrow">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.612585 11.85L5.46258 6.99999L0.612585 2.14999C0.496857 2.03426 0.405058 1.89687 0.342427 1.74567C0.279795 1.59446 0.247559 1.4324 0.247559 1.26874C0.247559 1.10507 0.279795 0.943013 0.342427 0.791808C0.405058 0.640603 0.496857 0.503214 0.612585 0.387487C0.728312 0.27176 0.8657 0.179959 1.01691 0.117328C1.16811 0.0546971 1.33017 0.0224609 1.49383 0.0224609C1.6575 0.0224609 1.81956 0.0546971 1.97076 0.117328C2.12197 0.179959 2.25936 0.27176 2.37508 0.387487L8.11258 6.12499C8.60008 6.61249 8.60008 7.39999 8.11258 7.88749L2.37508 13.625C2.25944 13.7409 2.12208 13.8328 1.97086 13.8955C1.81965 13.9583 1.65754 13.9905 1.49383 13.9905C1.33012 13.9905 1.16802 13.9583 1.0168 13.8955C0.865588 13.8328 0.728227 13.7409 0.612585 13.625C0.137585 13.1375 0.125085 12.3375 0.612585 11.85Z"
                              fill="#363636"></path>
                    </svg>
                </a>
            </li>
        @else
            <li>
                <a href="#" class="next pagination-arrow">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.612585 11.85L5.46258 6.99999L0.612585 2.14999C0.496857 2.03426 0.405058 1.89687 0.342427 1.74567C0.279795 1.59446 0.247559 1.4324 0.247559 1.26874C0.247559 1.10507 0.279795 0.943013 0.342427 0.791808C0.405058 0.640603 0.496857 0.503214 0.612585 0.387487C0.728312 0.27176 0.8657 0.179959 1.01691 0.117328C1.16811 0.0546971 1.33017 0.0224609 1.49383 0.0224609C1.6575 0.0224609 1.81956 0.0546971 1.97076 0.117328C2.12197 0.179959 2.25936 0.27176 2.37508 0.387487L8.11258 6.12499C8.60008 6.61249 8.60008 7.39999 8.11258 7.88749L2.37508 13.625C2.25944 13.7409 2.12208 13.8328 1.97086 13.8955C1.81965 13.9583 1.65754 13.9905 1.49383 13.9905C1.33012 13.9905 1.16802 13.9583 1.0168 13.8955C0.865588 13.8328 0.728227 13.7409 0.612585 13.625C0.137585 13.1375 0.125085 12.3375 0.612585 11.85Z"
                              fill="#363636"></path>
                    </svg>
                </a>
            </li>
        @endif
    </ul>
@endif