<!-- <link rel="stylesheet" href="/frontAssets/css/style.css"> -->
@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span><i class="fas fa-angle-left"></i></span></li>
        @else
            <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fas fa-angle-left"></i></a></li>
        @endif


        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item"><span class="page-link active">{{ $element }}</span></li>
            @endif


            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li  class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li  class="page-item"><a class="page-link" href="{{ $url.$paginate_pass }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-angle-right"></i></a></li>
        @else
            <li class="disabled"><span><i class="fas fa-angle-right"></i></span></li>
        @endif
    </ul>
@endif



{{--<ul class="pagination">--}}
{{--    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i> </a></li>--}}
{{--    <li class="page-item"><a class="page-link active" href="#">1 </a></li>--}}
{{--    <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--    <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i>  </a></li>--}}
{{--</ul>--}}
