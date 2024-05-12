<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>

{{-- Axios CDN --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{-- end Axios CDN --}}

<script src="{{ asset('dist_frontend/js/iziToast.min.js') }}"></script>

{{-- copy --}}
<script>
    function copyText() {
        var copyText = document.getElementById("salin");
        copyText.select();
        document.execCommand("copy");
        $('#exampleModal').modal('hide');
        $('#modalCopy').modal('show');
        // alert("Teks berhasil dicopy");
    }
</script>
{{-- end copy --}}
