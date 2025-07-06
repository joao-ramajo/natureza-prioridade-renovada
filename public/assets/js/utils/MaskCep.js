export function MaskCep(cep) {
    cep = cep.replace(/\D/g, '');
    cep = cep.replace(/^(\d{5})(\d)/, '$1-$2'); // Adiciona a máscara
    return cep;
}