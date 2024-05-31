<div class=" text-light grd-bg d-flex flex-column flex-shrink-0 p-2 sidebar-fixed rounded-4 rounded-start overflow-y-auto"
    id="sidebar-wrapper" style="width: 260px;">
    {{-- sidebar title --}}
    <div class="text-center mt-2">
        {{-- <img src="{{ asset('/storage/images/aclc.png') }}" alt="" width="75px" height="75px"> --}}
        <h3>@include('components.title')</h3>
        <hr>
    </div>

    <div class=" overflow-y-auto p-1 ">
        <ul class="nav nav-pills gap-2 flex-column">
            {{-- if admin access --}}
            @if (Auth::user()->type == 'ADMIN')
                <div class="nav-item">
                    <p class="text-light mb-2"><strong>Administrator Management</strong></p>
                </div>

                <li class="nav-item">
                    <a class="btn btn-primary w-100 text-start" data-bs-toggle="collapse" href="#collapseExample"
                        role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-caret-right-fill"></i>
                        Candidates
                    </a>
                </li>
                <div class="nav-item">
                    {{-- collapse content --}}
                    <div class="collapse" id="collapseExample">
                        <ul class="nav gap-2  nav-pills flex-column p-1">
                            <li class="nav-item">
                                <a href="{{ route('candidate.create') }}"
                                    class="btn btn-sm btn-outline-light text-start w-100">
                                    <i class="bi bi-person-add"></i>
                                    Add Candidate
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('candidate.index') }}"
                                    class="btn btn-sm btn-outline-light text-start w-100">
                                    <i class="bi bi-people"></i>
                                    Candidate List
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <li class="nav-item">
                    <a class="btn btn-primary w-100 text-start" data-bs-toggle="collapse" href="#collapseExample1"
                        role="button" aria-expanded="false" aria-controls="collapseExample1">
                        <i class="bi bi-caret-right-fill"></i>
                        Categories
                    </a>
                </li>
                <div class="nav-item">
                    {{-- collapse content --}}
                    <div class="collapse" id="collapseExample1">
                        <ul class="nav gap-2  nav-pills flex-column p-1">
                            <li class="nav-item">
                                <a href="{{ route('category.create') }}"
                                    class="btn btn-sm btn-outline-light text-start w-100">
                                    <i class="bi bi-bookmark-plus"></i>
                                    Create New Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}"
                                    class="btn btn-sm btn-outline-light text-start w-100">
                                    <i class="bi bi-tags"></i>
                                    Category List
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="nav-item">
                    <p class="text-light mb-2"><strong>User Management</strong></p>
                </div>

                <li class="nav-item">
                    <a class="btn btn-primary w-100 text-start" data-bs-toggle="collapse" href="#collapseExample2"
                        role="button" aria-expanded="false" aria-controls="collapseExample2">
                        <i class="bi bi-caret-right-fill"></i>
                        Users
                    </a>
                </li>
                <div class="nav-item">
                    {{-- collapse content --}}
                    <div class="collapse" id="collapseExample2">
                        <ul class="nav gap-2  nav-pills flex-column p-1">
                            <li class="nav-item">
                                <a href="{{ route('user.create') }}"
                                    class="btn btn-sm btn-outline-light text-start w-100">
                                    <i class="bi bi-person-fill"></i>
                                    Create New User
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                    class="btn btn-sm btn-outline-light text-start w-100">
                                    <i class="bi bi-people"></i>
                                    User List
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

            {{-- if judge access --}}
            @if (Auth::user()->type == 'JUDGE' || Auth::user()->type == 'ADMIN')
                <div class="nav-item">
                    <p class="text-light mb-2"><strong>Judge</strong></p>
                </div>

                {{-- only the judge can access --}}
                @if (Auth::user()->type == 'JUDGE')
                    <li class="nav-item">
                        <a class="btn btn-primary w-100 text-start" href="{{ url('home') }}"
                            role="button">
                            <i class="bi bi-house"></i>
                            Home
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="btn btn-primary w-100 text-start" data-bs-toggle="collapse" href="#collapseExample3"
                        role="button" aria-expanded="false" aria-controls="collapseExample3">
                        <i class="bi bi-caret-right-fill"></i>
                        Score Candidates
                    </a>
                </li>
                <div class="nav-item">
                    {{-- collapse content --}}
                    <div class="collapse" id="collapseExample3">
                        <ul class="nav gap-2  nav-pills flex-column p-1">
                            {{-- list of categories --}}
                            @forelse ($categories_list as $category)
                                <li class="nav-item">
                                    <a href="{{ route('scoreCandidate', $category->category_id) }}"
                                        class="btn btn-sm btn-outline-light text-start w-100">
                                        <i class="bi bi-book"></i>
                                        {{ $category->title }}
                                    </a>
                                </li>
                            @empty
                                <li class="nav-item">
                                    <span class="text-muted text-center">
                                        No Categories
                                    </span>
                                </li>
                            @endforelse

                        </ul>
                    </div>
                </div>
            @endif

            {{-- access by admin --}}
            @if (Auth::user()->type == 'ADMIN')
                <li class="nav-item">
                    <a class="btn btn-primary w-100 text-start" data-bs-toggle="collapse" href="#collapseExample4"
                        role="button" aria-expanded="false" aria-controls="collapseExample4">
                        <i class="bi bi-caret-right-fill"></i>
                        Reports
                    </a>
                </li>
                <div class="nav-item">
                    {{-- collapse content --}}
                    <div class="collapse" id="collapseExample4">
                        <ul class="nav gap-2  nav-pills flex-column p-1">
                            <li class="nav-item">
                                <a href="{{ route('showJudgesResults', 0) }}" class="btn btn-sm btn-outline-light text-start w-100">
                                    <i class="bi bi-book"></i>
                                    Scores By Judge
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('showResults') }}"
                                    class="btn btn-sm btn-outline-light text-start w-100">
                                    <i class="bi bi-book"></i>
                                    Results
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

            {{-- options candidate --}}
            {{-- <li class="nav-item">
                <a class="btn btn-primary w-100 text-start" href="{{ route('candidate.index') }}" role="button">
                    <i class="bi bi-list"></i>
                    Candidate
                </a>
                <div class="ps-2 mt-2">
                    @if (Request::segment(1) == 'candidate')
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="{{ route('candidate.create') }}"
                                    class="nav-link text-light scroll-target hover-effect">
                                    <i class="bi bi-person-add"></i>
                                    Add Candidate
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('candidate.edit', 0) }}"
                                    class="nav-link text-light scroll-target hover-effect">
                                    <i class="bi bi-person-gear"></i>
                                    Candidate Edit
                                </a>
                            </li>
                        </ul>
                    @endif
                </div>
            </li> --}}

            {{-- options judges --}}
            {{-- <li class="nav-item">
                <a class="btn btn-primary w-100 text-start" href="{{ route('judge.index') }}" role="button">
                    <i class="bi bi-list"></i>
                    Judge
                </a>
                <div class="ps-2 mt-2">
                    @if (Request::segment(1) == 'judge')
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="{{ route('judge.create') }}"
                                    class="nav-link text-light scroll-target hover-effect">
                                    <i class="bi bi-person-add"></i>
                                    Add Judge
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('judge.edit', 0) }}"
                                    class="nav-link text-light scroll-target hover-effect">
                                    <i class="bi bi-person-gear"></i>
                                    Judge Edit
                                </a>
                            </li>
                        </ul>
                    @endif
                </div>
            </li> --}}

            {{-- options Category --}}
            {{-- <li class="nav-item">
                <a class="btn btn-primary w-100 text-start" href="{{ route('category.index') }}" role="button">
                    <i class="bi bi-list"></i>
                    Category
                </a>
                <div class="ps-2 mt-2">
                    @if (Request::segment(1) == 'category' || Request::segment(1) == 'criteria')
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="{{ route('category.create') }}"
                                    class="nav-link text-light scroll-target hover-effect">
                                    <i class="bi bi-bookmark-plus"></i>
                                    Add Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.show', 0) }}"
                                    class="nav-link text-light scroll-target hover-effect">
                                    <i class="bi bi-bookmark"></i>
                                    Category Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.edit', 0) }}"
                                    class="nav-link text-light scroll-target hover-effect">
                                    <i class="bi bi-person-gear"></i>
                                    Category Edit
                                </a>
                            </li>

                            <hr class="m-2">

                            <li class="nav-item">
                                <a href="{{ route('criteria.create') }}"
                                    class="nav-link text-light scroll-target hover-effect">
                                    <i class="bi bi-bookmark-plus"></i>
                                    Add Criteria
                                </a>
                            </li>
                        </ul>
                    @endif
                </div>
            </li> --}}

            {{-- options judge scores
            <li class="nav-item">
                <a class="btn btn-primary w-100 text-start" href="{{ route('judgeScores', 0) }}" role="button">
                    <i class="bi bi-list"></i>
                    Judge Scores
                </a>
                <div class="ps-2 mt-2">
                    @if (Request::segment(1) == 'judgeScores')
                        <ul class="nav nav-pills flex-column">
                            @forelse ($Judges as $judge)
                                <li class="nav-item">
                                    <a href="{{ route('judgeScores', $judge->id) }}"
                                        class="nav-link text-light scroll-target hover-effect">
                                        <i class="bi bi-person-add"></i>
                                        {{ $judge->firstname }} {{ $judge->lastname }}
                                    </a>
                                </li>
                            @empty
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-light scroll-target hover-effect">
                                        No Judge yet
                                    </a>
                                </li>
                            @endforelse
                        </ul>
                    @endif
                </div>
            </li>

            options judge scores
            <li class="nav-item">
                <a class="btn btn-primary w-100 text-start" href="{{ route('candidateScores', 0) }}" role="button">
                    <i class="bi bi-list"></i>
                    Candidates Scores
                </a>
                <div class="ps-2 mt-2">
                    @if (Request::segment(1) == 'candidateScores')
                        <ul class="nav nav-pills flex-column">
                            @foreach ($Categories as $category)
                                <li class="nav-item">
                                    <a href="{{ route('candidateScores', $category->id) }}"
                                        class="nav-link text-light scroll-target hover-effect">
                                        <i class="bi bi-person-add"></i>
                                        {{ $category->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </li> --}}

            {{-- options results --}}
            {{-- <li class="nav-item">
                <a class="btn btn-primary w-100 text-start" href="{{ url('results') }}" role="button">
                    <i class="bi bi-list"></i>
                    Results
                </a>
            </li> --}}
        </ul>
    </div>

    <div class="flex-column mt-auto">
        <hr>
        <p class="text-center">
            &copy; ACLC Tabulation System {{ date('Y') }}
            <a href="https://www.tiktok.com/@thedirtiestrat" class="text-light text-decoration-none"
                target="_blank">Dunhill Leal (Mr. Dirtiest Rat)</a>
        </p>
    </div>
</div>
