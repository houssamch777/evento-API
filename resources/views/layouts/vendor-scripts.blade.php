<!-- JAVASCRIPT -->
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/metismenujs/metismenujs.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/eva-icons/eva.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const toggleBtn = document.getElementById('theme-toggle-btn');
    const currentTheme = sessionStorage.getItem('theme') || 'light';
    
    // Apply current theme on page load
    document.body.setAttribute('data-bs-theme', currentTheme);
    
    toggleBtn.addEventListener('click', function() {
        const newTheme = document.body.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
        document.body.setAttribute('data-bs-theme', newTheme);
        sessionStorage.setItem('theme', newTheme); // Save user preference in sessionStorage
    });
});

</script>

        <!-- Sweet Alerts js -->
        <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

        <!-- Sweet alert init js-->
<script src="{{ URL::asset('build/js/pages/sweet-alerts.init.js') }}"></script>

@if (session('success'))
<script>
    // SweetAlert for success message
    swal({
        title: "Success!",
        text: "{{ session('success') }}",
        type: "success",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif
@if (session('success'))
<script>
    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
</script>
@endif

@yield('scripts')
