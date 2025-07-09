import { InputValid } from "../utils/InputValid.js";
import { MaskCep } from "../utils/MaskCep.js";
import { ViaCep } from "../utils/ViaCepApi.js";
const InputCep = document.getElementById('cep')


InputCep.addEventListener('input', (event) => {
    event.target.value = MaskCep(event.target.value);
})


InputCep.addEventListener('blur', () => {
    var cep = InputCep.value
    if (cep.length == 9) {
        ViaCep(cep.replace('-', ''))
        InputValid(true, InputCep)
    } else {
        InputValid(false, InputCep)
    }
})

