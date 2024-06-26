@extends('frontend.layouts2.main2')

@section('title', 'ASET DIGITAL | Detail Post')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            @php
                $ext = pathinfo($post->file, PATHINFO_EXTENSION);
                $extRaw = pathinfo($post->file_mentah, PATHINFO_EXTENSION);
            @endphp

            @include('frontend.detail.photo')

            @include('frontend.detail.video')

            @include('frontend.detail.audio')

            @include('frontend.detail.youtube')

            @include('frontend.detail.drive')
        </div>
    </div>

    {{-- Modal --}}
    @auth
        <div class="modal fade" id="subscribe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><span class="text-orange">
                                <i class="bi bi-exclamation-triangle-fill"></i></span>
                            Penting !!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tidak bisa melakukan download</p>
                        <p>Klik Go Premium agar anda bisa mendownload file ini...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-orange btn-danger"
                            href="{{ route('show_premium', Auth::user()->name) }}">Go
                            Premium</a>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    <!-- Modal 2-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-12 text-center">
                            <img src="{{ asset('dist_frontend/img/alert.gif') }}" alt="" width="100px">
                        </div>
                        <div class="col col-12 mt-2">
                            <p class="fs-5 p-3"> Ingatlah untuk mention
                                creator dan sumber
                                saat menggunakan file ini. Salin detail atribute di bawah
                                ini dan sertakan di project atau situs web Anda.</p>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="button-addon2" value="{{ $message }}"
                            id="salin">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="copyText()"><i
                                class="bi bi-files"></i></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-orange btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3-->
    <div class="modal fade" id="modalCopy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-12 mt-2 text-center">
                            <span class="text-success fs-1"><img src="{{ asset('dist_frontend/img/approved.gif') }}"
                                    class="img fluid w-25" alt=""></span>
                            <p class="fs-4">Teks berhasil disalin.</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col col-2">
                            <button type="button" class="btn btn-sm btn-orange btn-danger"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- download button --}}
    <script>
        var file = '{{ $post->file }}';
        var fileMentah = '{{ $post->file_mentah }}';
        var url = '{{ $post->url }}';
    </script>

    <script>
        $(document).ready(function() {
            console.log('aasdasd');
            // var downloadType = $(this).data('download-type');
            var raw = document.getElementById('raw');
            var normal = document.getElementById('normal');
            var formAction;
            if (raw) {
                formAction = '{{ route('download-raw', 'file_mentah_value') }}'.replace(
                    'file_mentah_value', fileMentah);
            }
            console.log(downloadType);
            $('.download-btn').click(function(e) {
                e.preventDefault(); // membatalkan tindakan default tombol download

                // Mengambil URL dari formulir berdasarkan jenis download
                var formAction;
                var downloadType = $(this).data('download-type');

                // Mendapatkan token CSRF dari meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Membuat URL dengan menyertakan token CSRF
                var downloadUrl = formAction + '?_token=' + csrfToken;

                // Mengatur href elemen link yang disembunyikan dengan URL yang disiapkan
                if (downloadType === 'normal') {
                    $('#downloadLink').attr('href', downloadUrl);
                    $('#downloadLink')[0].click();
                } else if (downloadType === 'raw') {
                    $('#downloadLinkRaw').attr('href', downloadUrl);
                    $('#downloadLinkRaw')[0].click();
                }

                // menampilkan modal setelah proses download selesai
                $('#exampleModal').modal('show');
            });
        });
    </script>
    {{-- end download button --}}
@endsection
