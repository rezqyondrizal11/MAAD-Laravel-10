@extends('frontend.layouts.main')

@section('title', 'MAD')

@section('container')
{{-- {{ phpinfo() }} --}}
    <div class="container mt-3">
        {{-- Filter Resolution --}}
        <div class="btn-group dropend {{ Request::is('photo', 'photo/*') ? '' : 'd-none' }} mt-3">
            <button type="button" class="btn btn-danger btn-sm">
                Resolution
            </button>
            <button type="button" class="btn btn-danger btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
                aria-expanded="false">
                <span class="visually-hidden">Toggle Dropend</span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('photo') }}" class="dropdown-item">All</a>
                </li>
                @foreach ($reso as $item)
                    @if ($item->resolution == '')
                        <li><a href="{{ route('photo') }}" class="dropdown-item">{{ $item->resolution }}</a>
                        </li>
                    @else
                        <li><a href="{{ route('reso', $item->resolution) }}"
                                class="dropdown-item">{{ $item->resolution }}</a>
                        </li>
                    @endif
                    {{-- @elseif (Request::path() == 'photo')
                        <li><a href="" class="dropdown-item">{{ $item->resolution }}</a>
                        </li> --}}
                @endforeach
            </ul>
        </div>
        {{-- end Filter Resolution --}}

        <div class="row">
            @foreach ($post as $item)
            @php
            $ext = pathinfo($item->file, PATHINFO_EXTENSION)
            @endphp

                {{-- Photo --}}
                @if (Request::path() == 'photo')

                    @if (in_array($ext, ['jpg', 'png', 'jpeg']))
                        <div class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
                            <div class="card-custom shadow rounded-3 mx-auto">
                                 <img src="{{ asset('uploads/photo/compress/' .$item->file) }}" alt="Card Image" class="img-fluid" />
                                <div class="category-logo">
                                    <i class="bi bi-image-fill"></i>
                                </div>
                                <div class="deskripsi">
                                    <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                    <p class="fs-6 teks">{{ $item->body }}</p>
                                    <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                </div>
                            </div>
                        </div>
                    @elseif ($item->urlgd && $item->rCategory->name == 'Photo')
                        <div class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
                            <div class="card-custom shadow rounded-3 mx-auto">
                                <iframe src="{{ $item->urlgd }}" width="640" height="480" allow="autoplay" class="gd"></iframe>
                                <div class="category-logo">
                                    <i class="bi bi-image-fill"></i>
                                </div>
                                <div class="deskripsi">
                                   <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                    <p class="fs-6 teks">{{ $item->body }}</p>
                                    <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Request::path() == 'photo/*')
                        <div class="mt-4"></div>
                        {{ $post->links() }}
                    @endif

                    {{-- Video --}}
                @elseif (Request::path() == 'video')
                    @if ($ext)
                    <ataiv class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
                        <div class="card-custom shadow rounded-3 mx-auto">
                                <video class="" controls>
                                @if ($ext == 'mp4')
                                    <source src="{{ asset('uploads/video/' .$item->file) }}" alt="" type="video/mp4">
                                @endif
                                @if ($ext == 'mkv')
                                    <source src="{{ asset('uploads/video/' .$item->file) }}" alt="" type="video/mkv">
                                @endif
                                @if ($ext == 'webm')
                                    <source src="{{ asset('uploads/video/' .$item->file) }}" alt="" type="video/webm">
                                    @endif
                            </video>
                                <div class="category-logo">
                                   <i class="bi bi-film"></i>
                                </div>
                                <div class="deskripsi">
                                    <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                    <p class="fs-6 teks">{{ $item->body }}</p>
                                    <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                </div>
                            </div>
                    </ataiv>
                    @elseif ($item->url)
                        <div class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
                            <div class="card-custom shadow rounded-3 mx-auto">
                                <x-embed url="{{ $item->url }}" aspect-ratio="4:3" />
                                <div class="category-logo">
                                   <i class="bi bi-film"></i>
                                </div>
                                <div class="deskripsi">
                                    <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                    <p class="fs-6 teks">{{ $item->body }}</p>
                                    <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                </div>
                            </div>
                        </div>
                    @elseif ($item->urlgd && $item->rCategory->name == 'Video')
                    <div class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
                        <div class="card-custom shadow rounded-3 mx-auto">
                                <iframe src="{{ $item->urlgd }}" width="640" height="480" allow="autoplay" class="gd"></iframe>
                                <div class="category-logo">
                                    <i class="bi bi-film"></i>
                                </div>
                                <div class="deskripsi">
                                   <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                    <p class="fs-6 teks">{{ $item->body }}</p>
                                    <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                </div>
                            </div>
                    </div>
                    @endif

                    {{-- Audio --}}
                @elseif (Request::path() == 'audio')
                    @if (in_array($ext, ['mp3', 'm4a']))

                        <div class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
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
                                    @if ($ext == 'mp3')
                                        <audio src="{{ asset('uploads/audio/' .$item->file) }}" type="audio/mp3" controls class="waudio border border-success rounded-5"></audio>
                                    @endif
                                    @if ($ext == 'm4a')
                                        <audio src="{{ asset('uploads/audio/' .$item->file) }}" type="audio/m4a" controls class="waudio border border-success rounded-5"></audio>
                                        @endif
                                    <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                </div>
                            </div>
                        </div>

                    @elseif ($item->urlgd && $item->rCategory->name == 'Audio')
                        <div class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
                            <div class="card-custom shadow rounded-3 mx-auto">
                                <iframe src="{{ $item->urlgd }}" width="640" height="480" allow="autoplay" class="gd"></iframe>
                                <div class="category-logo">
                                    <i class="bi bi-music-note-beamed"></i>
                                </div>
                                <div class="deskripsi">
                                   <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                    <p class="fs-6 teks">{{ $item->body }}</p>
                                    <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Request::path() == 'audio/*')
                        <div class="mt-4"></div>
                        {{ $post->links() }}
                    @endif

                    {{-- Home --}}
                @else
                    @if (in_array($ext, ['jpg', 'png', 'jpeg']))
                         <div class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
                            <div class="card-custom shadow rounded-3 mx-auto">
                                <img src="{{ asset('uploads/photo/' .$item->file) }}" alt="Card Image" class="img-fluid" />
                                <div class="category-logo">
                                    <i class="bi bi-image-fill"></i>
                                </div>
                                <div class="deskripsi">
                                    <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                    <p class="fs-6 teks">{{ $item->body }}</p>
                                    <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (in_array($ext, ['mp4', 'mkv', 'webm']))
                        <div class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
                            <div class="card-custom shadow rounded-3 mx-auto">
                                <video class="" controls>
                                    @if ($ext == 'mp4')
                                        <source src="{{ asset('uploads/video/' .$item->file) }}" alt="" type="video/mp4">
                                    @endif
                                    @if ($ext == 'mkv')
                                        <source src="{{ asset('uploads/video/' .$item->file) }}" alt="" type="video/mkv">
                                    @endif
                                    @if ($ext == 'webm')
                                        <source src="{{ asset('uploads/video/' .$item->file) }}" alt="" type="video/webm">
                                        @endif
                                </video>
                                    <div class="category-logo">
                                    <i class="bi bi-film"></i>
                                    </div>
                                    <div class="deskripsi">
                                        <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                        <p class="fs-6 teks">{{ $item->body }}</p>
                                        <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                    </div>
                                </div>
                            </div>
                    @endif
                    @if (in_array($ext, ['mp3', 'm4a']))
                        <div class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
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
                                    @if ($ext == 'mp3')
                                        <audio src="{{ asset('uploads/audio/' .$item->file) }}" type="audio/mp3" controls class="waudio border border-success rounded-5"></audio>
                                    @endif
                                    @if ($ext == 'm4a')
                                        <audio src="{{ asset('uploads/audio/' .$item->file) }}" type="audio/m4a" controls class="waudio border border-success rounded-5"></audio>
                                        @endif
                                    <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Youtube --}}
                    @if ($item->url)
                        <div class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
                            <div class="card-custom shadow rounded-3 mx-auto">
                                <x-embed url="{{ $item->url }}" aspect-ratio="4:3" />
                                <div class="category-logo">
                                   <i class="bi bi-film"></i>
                                </div>
                                <div class="deskripsi">
                                    <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                    <p class="fs-6 teks">{{ $item->body }}</p>
                                    <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- end Youtube --}}

                    {{-- Googledrive --}}
                    @if ($item->urlgd)
                        <div class="col col-12 col-md-6 col-lg-3 mt-5" data-aos="fade-up" data-aos-duration="1200">
                        <div class="card-custom shadow rounded-3 mx-auto">
                                <iframe src="{{ $item->urlgd }}" width="640" height="480" allow="autoplay" class="gd"></iframe>
                                <div class="category-logo">
                                    @if ($item->rCategory->name == 'Photo')
                                        <i class="bi bi-image-fill"></i>
                                    @elseif ($item->rCategory->name == 'Video')
                                        <i class="bi bi-film"></i>
                                    @elseif ($item->rCategory->name == 'Audio')
                                        <i class="bi bi-music-note-beamed"></i>
                                    @endif
                                </div>
                                <div class="deskripsi">
                                   <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                    <p class="fs-6 teks">{{ $item->body }}</p>
                                    <a href="{{ route('detail', [$item->slug]) }}" class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                </div>
                            </div>
                    </div>
                    @endif
                    {{-- end Googledrive --}}
                @endif
            @endforeach
            {{-- @if ()

            @endif --}}
        </div>
        <div class="mt-5 mb-3">
            {{ $post->links() }}
        </div>
    </div>
@endsection
