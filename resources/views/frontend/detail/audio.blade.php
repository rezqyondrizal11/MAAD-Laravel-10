{{-- Audio --}}
@if (in_array($ext, ['mp3', 'm4a']))
    <div class="col col-12 col-lg-8 pt-5 order-2 order-lg-1">
        <div class="card shadow bg-dark rounded-5">
            <div class="card-header container text-center">
                <div class="music">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
            <div class="card-body text-center">
                <audio controls>
                    @if ($ext == 'mp3')
                        <source src="{{ asset('uploads/audio/' . $post->file) }}" alt="" type="audio/mp3">
                    @endif
                    @if ($ext == 'm4a')
                        <source src="{{ asset('uploads/audio/' . $post->file) }}" alt="" type="audio/m4a">
                    @endif
                </audio>
            </div>
        </div>
        {{-- Audio lainnya --}}
        <div class="row">
            <div class="" style="height: 10vh"></div>
            <div class="fw-bold">Aset Lainnya</div>
            @foreach ($posts as $item)
                @php
                    $extAudio = pathinfo($item->file, PATHINFO_EXTENSION);
                @endphp
                @if (in_array($extAudio, ['mp3', 'm4a']))
                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up" data-aos-duration="1200">
                        <div class="card-custom shadow rounded-3 mx-auto">
                            <div class="music p-5 bg-dark">
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </div>
                            <div class="category-logo">
                                <i class="bi bi-music-note-beamed"></i>
                            </div>
                            <div class="deskripsi">
                                <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                <p class="fs-6 teks">{{ $item->body }}</p>
                                @if ($extAudio == 'mp3')
                                    <audio src="{{ asset('uploads/audio/' . $item->file) }}" type="audio/mp3" controls
                                        class="waudio border border-success rounded-5"></audio>
                                @endif
                                @if ($extAudio == 'm4a')
                                    <audio src="{{ asset('uploads/audio/' . $item->file) }}" type="audio/m4a" controls
                                        class="waudio border border-success rounded-5"></audio>
                                @endif
                                <a href="{{ route('detail', [$item->slug]) }}"
                                    class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                            </div>
                        </div>
                    </div>
                @elseif ($item->urlgd && $item->rCategory->name == 'Audio')
                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up" data-aos-duration="1200">
                        <div class="card-custom shadow rounded-3 mx-auto">
                            <iframe src="{{ $item->urlgd }}" width="640" height="480" allow="autoplay"
                                class="gd"></iframe>
                            <div class="category-logo">
                                <i class="bi bi-music-note-beamed"></i>
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
        {{-- end Audio lainnya --}}
    </div>

    <div class="col col-12 col-lg-4 pt-lg-4 order-1 order-lg-2">
        <div class="container">
            <div class="row">
                <div class="col col-12 mt-2">
                    <div class="pt-5">
                        <span class="display-6 text-dark fw-bold">{{ $post->name }}</span>
                        <br />
                        <span class="small">by <a href="{{ route('profile', [$post->rUser->name]) }}"
                                class="text-decoration-none text-primary">{{ $post->rUser->name }}</a></span>
                        | <span class="small text-orange">{{ $post->rCategory->name }}</span> | <span
                            class="small text-success">{{ $ext }},
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
                            <div class="col col-12 col-lg-7 mt-3">
                                <form action="{{ route('download-raw', $post->file_mentah) }}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <button type="submit"
                                        class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal" data-download-type="raw">
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
                    @endif
                    {{-- end Login Pending --}}

                    <br>
                    <div class="col col-12 col-lg-7 mt-3">
                        <form action="{{ route('download', $post->file) }}" method="GET">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-sm btn-success download-btn form-control"
                                data-bs-toggle="modal" data-bs-target="#exampleModal" data-download-type="normal">
                                <span class="small"><i class="bi bi-download"></i> Download
                                    {{ $ext }}</span>
                            </button>
                            <!-- Tambahkan elemen link yang disembunyikan -->
                            <a id="downloadLink" href="#" style="display: none;">Download Link</a>
                        </form>
                    </div>

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

                    <div class="col col-12 col-lg-7 mt-3">
                        <a href="#" class="btn btn-sm btn-success form-control" onclick="loginfail()">
                            <span class="small"><i class="bi bi-download"></i> Download
                                {{ $ext }}</span>
                        </a>
                    </div>
                    {{-- end Tidak Login --}}
                @endauth

            </div>
        </div>
    </div>
@endif
{{-- end Audio --}}
