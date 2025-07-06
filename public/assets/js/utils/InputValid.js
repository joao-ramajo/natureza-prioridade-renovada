export function InputValid(status, campo) {
    if (status) {
        campo.classList.remove('is-invalid')
    } else {
        campo.classList.add('is-invalid')
    }
}