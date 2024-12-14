<div class="row g-0 align-items-center pb-4">
    <div class="col-sm-6">
        <div>
            <p class="mb-sm-0">
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }}
                entries
            </p>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="float-sm-end">
            <ul class="pagination mb-sm-0">
                <!-- Previous Page Link -->
                @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link text-success"><i class="mdi mdi-chevron-left"></i></a>
                </li>
                @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link text-success"><i
                            class="mdi mdi-chevron-left"></i></a>
                </li>
                @endif

                <!-- Pagination Links -->
                @foreach ($elements as $element)
                <!-- "Three Dots" Separator -->
                @if (is_string($element))
                <li class="page-item disabled">
                    <a class="page-link text-success">{{ $element }}</a>
                </li>
                @endif

                <!-- Array Of Links -->
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li class="page-item  active">
                    <a href="#" class="page-link btn-success">{{ $page }}</a>
                </li>
                @else
                <li class="page-item">
                    <a href="{{ $url }}" class="page-link text-success">{{ $page }}</a>
                </li>
                @endif
                @endforeach
                @endif
                @endforeach

                <!-- Next Page Link -->
                @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link text-success"><i
                            class="mdi mdi-chevron-right"></i></a>
                </li>
                @else
                <li class="page-item disabled">
                    <a class="page-link text-success"><i class="mdi mdi-chevron-right"></i></a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>