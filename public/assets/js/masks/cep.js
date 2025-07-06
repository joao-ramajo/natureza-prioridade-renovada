import { InputValid } from "../utils/InputValid.js";
import { MaskCep } from "../utils/MaskCep.js";

const InputCep = document.getElementById('cep')
const cepMessage = document.getElementById('cepMessage')
const viaCEP = async (cep) => {
    try {
        let url = `https://viacep.com.br/ws/${cep}/json/`
        const response = await fetch(url)
        const data = await response.json();


        if (data.erro) {
            cepMessage.classList.remove('d-none')
            throw new Error(data.erro)
        }

        document.getElementById('street').value = data.logradouro
        document.getElementById('city').value = data.localidade
        document.getElementById('complement').value = data.complemento
        document.getElementById('neighborhood').value = data.bairro
        document.getElementById('state').value = data.estado


    } catch (err) {
        cepMessage.innerHTML = "Desculpe, não conseguimos puxar as informações, por favor verifique o cep ou preencha manualmente."
        console.log(err);
    }
}

InputCep.addEventListener('input', (event) => {
    event.target.value = MaskCep(event.target.value);
})


InputCep.addEventListener('blur', () => {
    var cep = InputCep.value
    if (cep.length == 9) {
        viaCEP(cep.replace('-', ''))
        InputValid(true, InputCep)
    } else {
        InputValid(false, InputCep)
    }
})

