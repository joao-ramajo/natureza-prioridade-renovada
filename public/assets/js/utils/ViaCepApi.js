export async function ViaCep(cep) {
    try {
        let url = `https://viacep.com.br/ws/${cep}/json/`
        const response = await fetch(url)
        const data = await response.json();

        if (data.erro) {
            document.getElementById('cepMessage').classList.remove('d-none')
            throw new Error(data.erro)
        }

        document.getElementById('street').value = data.logradouro
        document.getElementById('city').value = data.localidade
        document.getElementById('complement').value = data.complemento
        document.getElementById('neighborhood').value = data.bairro
        document.getElementById('state').value = data.uf


    } catch (err) {
        document.getElementById('cepMessage').innerHTML = "Desculpe, não conseguimos puxar as informações, por favor verifique o cep ou preencha manualmente."
        console.log(err);
    }
}