<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/ece9031cab.js" crossorigin="anonymous"></script>


<script>
    window.addEventListener('DOMContentLoaded', () => {
        const darkModeEnabled = <?= $darkMode ? 'true' : 'false' ?>;

        if (darkModeEnabled) {
            document.body.classList.add('dark');
            document.documentElement.classList.add('dark');

            const imgPreview = document.querySelector('#imgPreviewAddPost');
            if (imgPreview) {
                imgPreview.src = "/PFC/app/assets/addPostDark.png";
            }

            const logos = document.querySelectorAll('.logo');
            logos.forEach(logo => {
                logo.src = "/PFC/app/assets/logo-dark.png";
            });
        } else {
            document.querySelectorAll('.logo').forEach(logo => {
                logo.src = "/PFC/app/assets/logo.png";

                const imgPreview = document.querySelector('#imgPreviewAddPost');
                if (imgPreview) {
                    imgPreview.src = "/PFC/app/assets/addPost.png";
                }
            })
        }
    });

    document.querySelector('#theme-switch').addEventListener('click', () => {
        const isDarkMode = document.body.classList.toggle('dark')
        document.documentElement.classList.toggle('dark');

        const logos = document.querySelectorAll('.logo');
        logos.forEach(logo => {
            if (isDarkMode) {
                logo.src = "/PFC/app/assets/logo-dark.png";
            } else {
                logo.src = "/PFC/app/assets/logo.png";
            }
        });

        const imgPreview = document.querySelector('#imgPreviewAddPost');
        if (imgPreview) {
            if (isDarkMode) {
                imgPreview.src = "/PFC/app/assets/addPostDark.png"
            } else {
                imgPreview.src = "/PFC/app/assets/addPost.png";

            }
        }

        document.cookie = `darkMode=${isDarkMode}; path=/; max-age=31536000`; // 1 ano

    })
</script>
</body>

</html>