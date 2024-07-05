{{-- Youtube --}}
@if ($post->url)
    <div class="col col-12 col-lg-8 pt-5 order-2 order-lg-1">
        <div class="card shadow rounded-5">
            <x-embed url="{{ $post->url }}" aspect-ratio="10:5" style="width: 400px; height: 300px;" />
        </div>

        {{-- Video lainnya --}}
        <div class="row">
            <div class="" style="height: 10vh"></div>
            <div class="fw-bold">Aset Lainnya</div>
            @foreach ($posts as $item)
                @php
                    $extVideo = pathinfo($item->file, PATHINFO_EXTENSION);
                @endphp
                @if (in_array($extVideo, ['mp4', 'mkv', 'webm']))
                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up" data-aos-duration="1200">
                        <div class="card-custom shadow rounded-3 mx-auto">
                            <video class="" controls>
                                @if ($extVideo == 'mp4')
                                    <source src="{{ url('files/video/' . $item->file) }}" alt=""
                                        type="video/mp4">
                                @endif
                                @if ($extVideo == 'mkv')
                                    <source src="{{ url('files/video/' . $item->file) }}" alt=""
                                        type="video/mkv">
                                @endif
                                @if ($extVideo == 'webm')
                                    <source src="{{ url('files/video/' . $item->file) }}" alt=""
                                        type="video/webm">
                                @endif
                            </video>
                            <div class="category-logo">
                                <i class="bi bi-film"></i>
                            </div>
                            <div class="deskripsi">
                                <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                <p class="fs-6 teks">{{ $item->body }}</p>
                                <a href="{{ route('detail', [$item->slug]) }}"
                                    class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                            </div>
                        </div>
                    </div>
                @elseif ($item->url)
                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up" data-aos-duration="1200">
                        <div class="card-custom shadow rounded-3 mx-auto">
                            <x-embed url="{{ $item->url }}" aspect-ratio="4:3" />
                            <div class="category-logo">
                                <i class="bi bi-film"></i>
                            </div>
                            <div class="deskripsi">
                                <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                <p class="fs-6 teks">{{ $item->body }}</p>
                                <a href="{{ route('detail', [$item->slug]) }}"
                                    class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                            </div>
                        </div>
                    </div>
                @elseif ($item->urlgd && $item->rCategory->name == 'Video')
                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up" data-aos-duration="1200">
                        <div class="card-custom shadow rounded-3 mx-auto">
                            <iframe src="{{ $item->urlgd }}" width="640" height="480" allow="autoplay"
                                class="gd"></iframe>
                            <div class="category-logo">
                                <i class="bi bi-film"></i>
                            </div>
                            <div class="deskripsi">
                                <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                <p class="fs-6 teks">{{ $item->body }}</p>
                                <a href="{{ route('detail', [$item->slug]) }}"
                                    class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{-- end Video lainnya --}}
    </div>

    <div class="col col-12 col-lg-4 pt-5 order-1 order-lg-2">
        <div class="container">
            <div class="row">
                <div class="col col-12 mt-2">
                    <div class="pt-5">
                        <span class="display-6 text-dark fw-bold">{{ $post->name }}</span>
                        <br />
                        <span class="small">by <a href="{{ route('profile', [$post->rUser->name]) }}"
                                class="text-decoration-none text-primary">{{ $post->rUser->name }}</a></span>
                        | <span class="small text-orange">{{ $post->rCategory->name }}</span> | <span
                            class="small text-success">Youtube,
                            {{ $extRaw }}</span>
                        <p class="pt-4">
                            {{ $post->body }}
                        </p>
                    </div>
                </div>

                @auth
                    <a href="{{ route('like', $post->id) }}" class="text-decoration-none text-danger"><span
                            class="small"><i class="bi bi-heart-fill"></i>
                            {{ $like }} Like</span></a>

                    {{-- Login Premium --}}
                    @if (Auth::guard('web')->user()->role == 'premium' || Auth::guard('web')->user()->id == $post->user_id)
                        @if ($post->file_mentah)
                            <div class="col col-12 col-lg-7 mt-3 ">
                                <form action="{{ route('download-raw', $post->file_mentah) }}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <button type="submit"
                                        class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal" id="raw"
                                        data-download-type="raw">
                                        <span class="small"><i class="bi bi-download"></i> Download
                                            {{ $extRaw }}</span>
                                    </button>
                                    <!-- Tambahkan elemen link yang disembunyikan -->
                                    <a id="downloadLinkRaw" href="#" style="display: none;">Download
                                        Link</a>
                                </form>
                            </div>
                        @elseif ($post->fpgd)
                            <div class="col col-12 col-lg-7 mt-3">
                                <a href="{{ $post->fpgd }}" class="btn btn-sm btn-primary form-control" target="blank">
                                    <span class="small"><i class="bi bi-download"></i>
                                        Googledrive</span>
                                </a>
                            </div>
                        @endif
                        {{-- end Login Premium --}}
                        {{-- Login Umum --}}
                    @elseif (Auth::guard('web')->user()->role == 'umum')
                        @if ($post->file_mentah)
                            <div class="col col-12 col-lg-7 mt-3">
                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                    data-bs-toggle="modal" data-bs-target="#subscribe">
                                    <span class="small"><i class="bi bi-download"></i>
                                        Download {{ $extRaw }}</span>
                                </a>
                            </div>
                        @elseif ($post->fpgd)
                            <div class="col col-12 col-lg-7 mt-3">
                                <a href="#" class="btn btn-sm btn-primary form-control" data-bs-toggle="modal"
                                    data-bs-target="#subscribe">
                                    <span class="small"><i class="bi bi-download"></i>
                                        Googledrive</span>
                                </a>
                            </div>
                        @endif
                        {{-- end Login Umum --}}
                        {{-- Login Pending --}}
                    @elseif (Auth::guard('web')->user()->role == 'pending')
                        @if ($post->file_mentah)
                            <div class="col col-12 col-lg-7 mt-3">
                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                    onclick="loginpending()">
                                    <span class="small"><i class="bi bi-download"></i>
                                        Download {{ $extRaw }}</span>
                                </a>
                            </div>
                        @elseif ($post->fpgd)
                            <div class="col col-12 col-lg-7 mt-3">
                                <a href="#" class="btn btn-sm btn-primary form-control" onclick="loginpending()">
                                    <span class="small"><i class="bi bi-download"></i>
                                        Googledrive</span>
                                </a>
                            </div>
                        @endif
                        {{-- end Login Pending --}}
                    @endif
                    {{-- Tidak Login --}}
                @else
                    <a href="#" class="text-decoration-none text-danger" onclick="loginfail()"><span
                            class="small"><i class="bi bi-heart-fill"></i>
                            {{ $like }} Like</span></a>
                    @if ($post->file_mentah)
                        <div class="col col-12 col-lg-7 mt-3">
                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                onclick="loginfail()">
                                <span class="small"><i class="bi bi-download"></i>
                                    Download {{ $extRaw }}</span>
                            </a>
                        </div>
                    @elseif ($post->fpgd)
                        <div class="col col-12 col-lg-7 mt-3">
                            <a href="#" class="btn btn-sm btn-primary form-control" onclick="loginfail()">
                                <span class="small"><i class="bi bi-download"></i>
                                    Googledrive</span>
                            </a>
                        </div>
                    @endif

                    {{-- end Tidak Login --}}
                @endauth

            </div>
        </div>
    </div>
@endif
{{-- end Youtube --}}
