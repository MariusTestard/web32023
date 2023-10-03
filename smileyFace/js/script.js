document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        var errorElement = document.getElementById('eventErrorMessage');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    }, 2500);
});
