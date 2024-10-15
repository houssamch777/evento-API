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
@yield('scripts')
