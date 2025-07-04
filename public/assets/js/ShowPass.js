const checkbox = document.getElementById('showPassCheckbox');
const pass = document.getElementById('password');
const confirm = document.getElementById('password_confirmation');

if (checkbox) {
    checkbox.addEventListener('change', () => {
        if (pass) {
            checkbox.checked ? pass.type = 'text' : pass.type = 'password'
        }
        if (confirm) {
            checkbox.checked ? confirm.type = 'text' : confirm.type = 'password'
        }
    })
}
