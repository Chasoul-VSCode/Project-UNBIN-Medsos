function validateForm() {
    var password = document.getElementById('password').value;
    var alert = document.getElementById('passwordAlert');

    if (password.length < 8) {
        alert.style.display = 'block';
        return false;
    }

    alert.style.display = 'none';
    return true;
}