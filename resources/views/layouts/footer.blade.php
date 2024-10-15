<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © Evanto.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://witslinks.com/" target="_blank" class="text-reset">Witslinks</a>
                </div>
            </div>
        </div>
    </div>
</footer>
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