<div class=" bg-light d-flex flex-column flex-shrink-0 p-3 rounded-start rounded-5 shadow sidebar-fixed"
    id="sidebar-wrapper" style="width: 260px;">

    <ul class="nav nav-pills gap-2 flex-column mb-auto overflow-x-scroll">
        <li class="nav-item text-center">
            <h2>@include('components.title')</h2>
            <hr>
        </li>

        {{-- options candidate --}}
        <li class="nav-item">
            <a class="btn btn-danger w-100 text-start" href="{{ route('scoreByCategory', 0) }}" role="button">
                <i class="bi bi-list"></i>
                School Candidate
            </a>
            <div class="ps-2 mt-2">
                <ul class="nav nav-pills flex-column">
                    {{-- category list --}}
                    @foreach ($Categories as $Category)
                        @if ($Category->title != 'Top 3')
                            <li class="nav-item">
                                <a href="{{ route('scoreByCategory', $Category->id) }}"
                                    class="nav-link text-dark scroll-target hover-effect">
                                    <i class="bi bi-bookmark-fill"></i>
                                    {{ $Category->title }}
                                </a>
                            </li>
                        @else
                            <hr class="m-2">

                            <li class="nav-item">
                                <a href="{{ route('Top3', '0999') }}"
                                    class="nav-link text-dark scroll-target hover-effect">
                                    <i class="bi bi-person-add"></i>
                                    Top 3
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </li>
    </ul>

    <hr>
    <div>
        @include('components.copyright')
    </div>
</div>
