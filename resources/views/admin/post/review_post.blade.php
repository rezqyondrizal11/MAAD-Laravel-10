@extends('admin.layouts.main')

@section('title', 'Post Show')

@section('main_content')
    <style>
        .text {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            text-overflow: ellipsis;
            /* height: 3em; */
            /* line-height: 1.5em; */
        }
    </style>
    <div class="container-fluid bg-light">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Review Post</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($posts as $post)
                        @php
                            $path_photo = asset('uploads/photo/compress/' . $post->file);
                            $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);

                            $path_video = asset('uploads/video/' . $post->file);
                            $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);

                            $path_audio = asset('uploads/audio/' . $post->file);
                            $extaudio = pathinfo($path_audio, PATHINFO_EXTENSION);

                            $path_gd = $post->urlgd;

                            $path_yt = $post->url;

                        @endphp
                        @if ($post->category_id == 3)
                            <div class="col col-12 col-xl-4">
                                <div class="card border-primary mb-3" style="height: 170px">
                                    {{-- <div class="card-header">{{ $post->name }}</div> --}}
                                    <div class="d-flex flex-row">
                                        @if ($post->file)
                                            <img src="{{ $path_photo }}" alt="" class="img-fluid rounded-left"
                                                style="height: 169px;">
                                        @endif
                                        @if ($post->urlgd)
                                            <iframe src="{{ $path_gd }}" style="height: 169px;" allow="autoplay"
                                                class="rounded-left"></iframe>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title text-primary text-capitalize text mb-0">
                                                {{ $post->name }}
                                            </h5>
                                            <div class="d-flex flex-row">
                                                <p class="small text-success">{{ $post->rCategory->name }}</p>
                                                <p class="small mx-1">|</p>
                                                <p class="small font-weight-bold">{{ $post->rUser->name }}</p>
                                            </div>

                                            <p class="card-text small text text-dark mb-2">{{ $post->body }}</p>
                                            <a href="#" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#exampleModalCenter{{ $post->id }}"><i
                                                    class="fa fa-check"></i>
                                                Acc</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @elseif ($post->category_id == 4)
                            <div class="col col-12 col-xl-4">
                                <div class="card border-success mb-3" style="height: 170px">
                                    {{-- <div class="card-header">{{ $post->name }}</div> --}}
                                    <div class="d-flex flex-row">
                                        @if ($post->file)
                                            <video class="object-fit-contain rounded-left" controls style="height:169px;">
                                                @if ($extvideo == 'mp4')
                                                    <source src="{{ $path_video }}" alt="" type="video/mp4">
                                                @endif
                                                @if ($extvideo == 'mkv')
                                                    <source src="{{ $path_video }}" alt="" type="video/mkv">
                                                @endif
                                                @if ($extvideo == 'webm')
                                                    <source src="{{ $path_video }}" alt="" type="video/webm">
                                                @endif
                                            </video>
                                        @endif
                                        @if ($post->urlgd)
                                            <iframe src="{{ $path_gd }}" style="height: 169px;" allow="autoplay"
                                                class="rounded-left"></iframe>
                                        @endif
                                        @if ($post->url)
                                            <x-embed url="{{ $post->url }}" class="rounded-left" />
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title text-success text-capitalize text mb-0">
                                                {{ $post->name }}
                                            </h5>
                                            <div class="d-flex flex-row">
                                                <p class="small text-danger">{{ $post->rCategory->name }}</p>
                                                <p class="small mx-1">|</p>
                                                <p class="small font-weight-bold">{{ $post->rUser->name }}</p>
                                            </div>

                                            <p class="card-text small text text-dark mb-2">{{ $post->body }}</p>
                                            {{-- <a href="{{ route('admin-post-acc', $post->slug) }}"
                                                class="btn btn-sm btn-info" onclick="return confirm('are you sure?')"><i
                                                    class="fa fa-check"></i>
                                                Acc</a> --}}
                                            <a href="#" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#exampleModalCenter{{ $post->id }}"><i
                                                    class="fa fa-check"></i>
                                                Acc</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @elseif ($post->category_id == 5)
                            <div class="col col-12 col-xl-4">
                                <div class="card border-danger mb-3" style="height: 170px">
                                    {{-- <div class="card-header">{{ $post->name }}</div> --}}
                                    <div class="d-flex flex-row">
                                        @if ($post->file)
                                            <div class="d-flex align-items-center">
                                                @if ($extaudio == 'mp3')
                                                    <audio src="{{ $path_audio }}" type="audio/mp3" controls></audio>
                                                @endif
                                                @if ($extaudio == 'm4a')
                                                    <audio src="{{ $path_audio }}" type="audio/m4a" controls></audio>
                                                @endif
                                            </div>
                                        @endif
                                        @if ($post->urlgd)
                                            <iframe src="{{ $path_gd }}" style="height: 169px;" allow="autoplay"
                                                class="rounded-left"></iframe>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title text-danger text-capitalize text mb-0">
                                                {{ $post->name }}
                                            </h5>
                                            <div class="d-flex flex-row">
                                                <p class="small text-primary">{{ $post->rCategory->name }}</p>
                                                <p class="small mx-1">|</p>
                                                <p class="small font-weight-bold">{{ $post->rUser->name }}</p>
                                            </div>

                                            <p class="card-text small text text-dark mb-2">{{ $post->body }}</p>
                                            <a href="#" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#exampleModalCenter{{ $post->id }}"><i
                                                    class="fa fa-check"></i>
                                                Acc</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif

                        {{-- Modal --}}
                        <div class="modal fade" id="exampleModalCenter{{ $post->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-capitalize text-primary" id="exampleModalLongTitle">
                                            {{ $post->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        @if ($post->category_id == 3)
                                            @if ($post->file)
                                                <img src="{{ $path_photo }}" alt="" class="img-fluid "
                                                    style="height: 169px;">
                                            @endif
                                            @if ($post->urlgd)
                                                <iframe src="{{ $path_gd }}" style="height: 169px;"
                                                    allow="autoplay" class=""></iframe>
                                            @endif
                                        @elseif ($post->category_id == 4)
                                            @if ($post->file)
                                                <video class="object-fit-contain rounded-left" controls
                                                    style="height:169px;">
                                                    @if ($extvideo == 'mp4')
                                                        <source src="{{ $path_video }}" alt=""
                                                            type="video/mp4">
                                                    @endif
                                                    @if ($extvideo == 'mkv')
                                                        <source src="{{ $path_video }}" alt=""
                                                            type="video/mkv">
                                                    @endif
                                                    @if ($extvideo == 'webm')
                                                        <source src="{{ $path_video }}" alt=""
                                                            type="video/webm">
                                                    @endif
                                                </video>
                                            @endif
                                            @if ($post->urlgd)
                                                <iframe src="{{ $path_gd }}" style="height: 169px;"
                                                    allow="autoplay" class="rounded-left"></iframe>
                                            @endif
                                            @if ($post->url)
                                                <x-embed url="{{ $post->url }}" class="rounded-left" />
                                            @endif
                                        @elseif ($post->category_id == 5)
                                            @if ($post->file)
                                                <div class="">
                                                    @if ($extaudio == 'mp3')
                                                        <audio src="{{ $path_audio }}" type="audio/mp3"
                                                            controls></audio>
                                                    @endif
                                                    @if ($extaudio == 'm4a')
                                                        <audio src="{{ $path_audio }}" type="audio/m4a"
                                                            controls></audio>
                                                    @endif
                                                </div>
                                            @endif
                                            @if ($post->urlgd)
                                                <iframe src="{{ $path_gd }}" style="height: 169px;"
                                                    allow="autoplay" class="rounded-left"></iframe>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-1">Kategori : <span
                                                class="text-success">{{ $post->rCategory->name }}</span></p>
                                        <p>{{ $post->body }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('admin-post-delete', $post->slug) }}" type="button"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Jika Tolak, maka Postingan akan dihapus, apa anda yakin?')">Tolak</a>
                                        <form action="{{ route('admin-post-acc', $post->slug) }}" method="post">
                                            @csrf
                                            <button type="submit" type="button"
                                                class="btn btn-sm btn-success">Acc</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
                {{-- <div class="row justify-content-center">
                    <div class="col col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-success text-light">
                                        <th scope="col">No</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Nama User</th>
                                        <th scope="col">Nama Post</th>
                                        <th scope="col">Postingan</th>
                                        <th scope="col">Postingan Project</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        @php
                                            $path_photo = asset('uploads/photo/compress/' . $post->file);
                                            $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);

                                            $path_video = asset('uploads/video/' . $post->file);
                                            $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);

                                            $path_audio = asset('uploads/audio/' . $post->file);
                                            $extaudio = pathinfo($path_audio, PATHINFO_EXTENSION);

                                            $path_gd = $post->urlgd;

                                            $path_yt = $post->url;

                                        @endphp

                                        @if ($post->category_id == 3)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $post->rCategory->name }}</td>
                                                <td>{{ $post->rUser->name }}</td>
                                                <td>{{ $post->name }}</td>
                                                <td>
                                                    @if ($post->file)
                                                        <img src="{{ $path_photo }}" alt="" class="img-fluid"
                                                            style="max-height:12rem;">
                                                    @endif
                                                    @if ($post->urlgd)
                                                        <iframe src="{{ $path_gd }}" style="max-height:12rem;"
                                                            allow="autoplay"></iframe>
                                                    @endif
                                                </td>
                                                <td>{{ $post->file_mentah }}</td>

                                                <td>
                                                    <a href="{{ route('admin-post-acc', $post->slug) }}"
                                                        class="btn btn-sm btn-info"
                                                        onclick="return confirm('are you sure?')"><i
                                                            class="fa fa-check"></i>
                                                        Acc</a>
                                                </td>
                                            </tr>
                                        @elseif ($post->category_id == 4)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $post->rCategory->name }}</td>
                                                <td>{{ $post->rUser->name }}</td>
                                                <td>{{ $post->name }}</td>
                                                <td>
                                                    @if ($post->file)
                                                        <video class="object-fit-contain rounded-4" controls
                                                            style="max-height:12rem;">
                                                            @if ($extvideo == 'mp4')
                                                                <source src="{{ $path_video }}" alt=""
                                                                    type="video/mp4">
                                                            @endif
                                                            @if ($extvideo == 'mkv')
                                                                <source src="{{ $path_video }}" alt=""
                                                                    type="video/mkv">
                                                            @endif
                                                            @if ($extvideo == 'webm')
                                                                <source src="{{ $path_video }}" alt=""
                                                                    type="video/webm">
                                                            @endif
                                                        </video>
                                                    @endif

                                                    @if ($post->urlgd)
                                                        <iframe src="{{ $path_gd }}" allow="autoplay"
                                                            style="max-height:12rem;"></iframe>
                                                    @endif

                                                    @if ($post->url)
                                                        <x-embed url="{{ $post->url }}" style="max-height:12rem;" />
                                                    @endif
                                                </td>
                                                <td>{{ $post->file_mentah }}</td>
                                                <td>
                                                    <a href="{{ route('admin-post-acc', $post->slug) }}"
                                                        class="btn btn-sm btn-info"
                                                        onclick="return confirm('are you sure?')"><i
                                                            class="fa fa-check"></i>
                                                        Acc</a>
                                                </td>
                                            </tr>
                                        @elseif ($post->category_id == 5)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $post->rCategory->name }}</td>
                                                <td>{{ $post->rUser->name }}</td>
                                                <td>{{ $post->name }}</td>
                                                <td>
                                                    @if ($post->file)
                                                        @if ($extaudio == 'mp3')
                                                            <audio src="{{ $path_audio }}" type="audio/mp3"
                                                                controls></audio>
                                                        @endif
                                                        @if ($extaudio == 'm4a')
                                                            <audio src="{{ $path_audio }}" type="audio/m4a"
                                                                controls></audio>
                                                        @endif
                                                    @endif

                                                    @if ($post->urlgd)
                                                        <iframe src="{{ $path_gd }}" style="max-height:12rem;"
                                                            allow="autoplay"></iframe>
                                                    @endif
                                                </td>
                                                <td>{{ $post->file_mentah }}</td>
                                                <td>
                                                    <a href="{{ route('admin-post-acc', $post->slug) }}"
                                                        class="btn btn-sm btn-info"
                                                        onclick="return confirm('are you sure?')"><i
                                                            class="fa fa-check"></i>
                                                        Acc</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
