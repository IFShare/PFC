const imgPost =
document.querySelectorAll('.imgPost');

imgPost.forEach((img) => {
if (img.complete) {
    img.style.opacity = 1;
    img.closest('.post').classList.remove('placeholder');
}
img.onload = function() {
    img.style.opacity = 1;
    img.closest('.post').classList.remove('placeholder');
};
img.onerror = function() {
    img.parentElement.style.backgroundColor = 'red';
};
});