const InputOpenTo = document.getElementById('open_to')
const InputOpenFrom = document.getElementById('open_from')


InputOpenTo.addEventListener('input', (e) => {
    e.target.value = e.target.value
    .replace(/\D/g, '')  // remove digitos  
    .replace(/(\d{2})(\d)/, '$1:$2') // inserindo : 
    .slice(0,5)
})
InputOpenFrom.addEventListener('input', (e) => {
    e.target.value = e.target.value
    .replace(/\D/g, '')  // remove digitos  
    .replace(/(\d{2})(\d)/, '$1:$2') // inserindo : 
    .slice(0,5)
})