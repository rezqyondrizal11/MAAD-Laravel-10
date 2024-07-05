@extends('frontend.layouts2.main2')

@section('title', 'ASET DIGITAL | Media')

@section('container')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col col-12">
                <div class="container px-5 py-3">
                    <div class="row">
                        <div class="row">
                            <div class="col-4">
                                <p class="fs-3 text-start">My Media</p>
                            </div>
                            <div class="col-8">
                                <form action="{{ route('post_show', $user->name) }}" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-md" placeholder="Search.."
                                            name="search_media" value="{{ request('search_media') }}">
                                        <button class="btn btn-md btn-danger warna_search" type="submit"><i
                                                class="bi bi-search text-light"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>

                        @foreach ($data as $item)
                            @php
                                $ext = pathinfo($item->file, PATHINFO_EXTENSION);
                            @endphp
                            {{-- Photo --}}
                            @if (in_array($ext, ['jpg', 'png', 'jpeg']))
                                <div class="col col-12 col-md-6 col-lg-3 mt-4" data-aos="fade-up" data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <img src="{{ url('files/photo/' . $item->file) }}" alt="Card Image"
                                            class="img-fluid" />
                                        <div class="category-logo">
                                            <i class="bi bi-image-fill"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="btn btn-primary btn-sm mt-3"><i class="bi bi-eye-fill"></i></a>
                                            <a href="{{ route('post_edit', $item->slug) }}"
                                                class="btn btn-warning text-light btn-sm mt-3"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteConfirmModal_{{ $item->id }}"
                                                class="btn btn-danger btn-sm mt-3"><i class="bi bi-trash3-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- end Photo --}}

                            {{-- Video --}}
                            @if (in_array($ext, ['mp4', 'mkv', 'webm']))
                                <div class="col col-12 col-md-6 col-lg-3 mt-4" data-aos="fade-up" data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <video class="" controls>
                                            @if ($ext == 'mp4')
                                                <source src="{{ url('files/video/' . $item->file) }}" alt=""
                                                    type="video/mp4">
                                            @endif
                                            @if ($ext == 'mkv')
                                                <source src="{{ url('files/video/' . $item->file) }}" alt=""
                                                    type="video/mkv">
                                            @endif
                                            @if ($ext == 'webm')
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
                                                class="btn btn-primary btn-sm mt-3"><i class="bi bi-eye-fill"></i></a>
                                            <a href="{{ route('post_edit', $item->slug) }}"
                                                class="btn btn-warning text-light btn-sm mt-3"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteConfirmModal_{{ $item->id }}"
                                                class="btn btn-danger btn-sm mt-3"><i class="bi bi-trash3-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- end Video --}}

                            {{-- Audio --}}
                            @if (in_array($ext, ['mp3', 'm4a']))
                                <div class="col col-12 col-md-6 col-lg-3 mt-4" data-aos="fade-up" data-aos-duration="1200">
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
                                                <audio src="{{ url('files/audio/' . $item->file) }}" type="audio/mp3"
                                                    controls class="waudio border border-success rounded-5"></audio>
                                            @endif
                                            @if ($ext == 'm4a')
                                                <audio src="{{ url('files/audio/' . $item->file) }}" type="audio/m4a"
                                                    controls class="waudio border border-success rounded-5"></audio>
                                            @endif
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="btn btn-primary btn-sm mt-3"><i class="bi bi-eye-fill"></i></a>
                                            <a href="{{ route('post_edit', $item->slug) }}"
                                                class="btn btn-warning text-light btn-sm mt-3"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteConfirmModal_{{ $item->id }}"
                                                class="btn btn-danger btn-sm mt-3"><i class="bi bi-trash3-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- end Audio --}}

                            {{-- Youtube --}}
                            @if ($item->url)
                                <div class="col col-12 col-md-6 col-lg-3 mt-4" data-aos="fade-up"
                                    data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <x-embed url="{{ $item->url }}" aspect-ratio="4:3" />
                                        <div class="category-logo">
                                            <i class="bi bi-film"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="btn btn-primary btn-sm mt-3"><i class="bi bi-eye-fill"></i></a>
                                            <a href="{{ route('post_edit', $item->slug) }}"
                                                class="btn btn-warning text-light btn-sm mt-3"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteConfirmModal_{{ $item->id }}"
                                                class="btn btn-danger btn-sm mt-3"><i class="bi bi-trash3-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- end Youtube --}}

                            {{-- GoogleDrive --}}
                            @if ($item->urlgd)
                                <div class="col col-12 col-md-6 col-lg-3 mt-4" data-aos="fade-up"
                                    data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <iframe src="{{ $item->urlgd }}" width="640" height="480"
                                            allow="autoplay" class="gd"></iframe>
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
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="btn btn-primary btn-sm mt-3"><i class="bi bi-eye-fill"></i></a>
                                            <a href="{{ route('post_edit', $item->slug) }}"
                                                class="btn btn-warning text-light btn-sm mt-3"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteConfirmModal_{{ $item->id }}"
                                                class="btn btn-danger btn-sm mt-3"><i class="bi bi-trash3-fill"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- end Googledrive --}}

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteConfirmModal_{{ $item->id }}" tabindex="-1"
                                aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('dist_frontend/img/bin.gif') }}" alt=""
                                                class="img-fluid w-25">
                                            <p>Anda yakin ingin menghapus file ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <a href="{{ route('post_delete', $item->slug) }}" type="button"
                                                class="btn btn-sm btn-danger" id="btnDeleteConfirm">Delete</a>
                                            <button disabled type="submit" class="btn btn-sm btn-danger"
                                                style="display: none" id="deletingBtn">
                                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                                Deleting...
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-5 mb-3">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
