import axiosClient from "./axios.js";

async function getTamanhos(tamanhos) {
    const response = await axiosClient.get('/api/tamanhos')
    tamanhos.value = Object.values(response.data).map(tamanho => ({
        name: tamanho["nome"],
        valor: tamanho["valor"],
        max_cremes: tamanho["max_cremes"],
        max_recheios: tamanho["max_recheios"],
        max_acompanhamentos: tamanho["max_acompanhamentos"],
        max_coberturas: tamanho["max_coberturas"],
    }));
}


// Those functions will receive empty arrays, then fill them with the info received by the API
async function getCremes(cremes) {
    const response = await axiosClient.get('/api/cremes');
    cremes.value = Object.values(response.data).map(creme => ({name: creme["nome"]}));
}

async function getRecheios(recheios) {
    const response = await axiosClient.get('/api/recheios');
    recheios.value = Object.values(response.data).map(recheio => ({name: recheio["nome"]}));
}

async function getAcompanhamentos(acompanhamentos) {
    const response = await axiosClient.get('/api/acompanhamentos');
    acompanhamentos.value = Object.values(response.data).map(acompanhamento => ({name: acompanhamento["nome"]}));
}

async function getCoberturas(coberturas) {
    const response = await axiosClient.get('/api/coberturas');
    coberturas.value = Object.values(response.data).map(cobertura => ({name: cobertura["nome"]}));
}


async function getPedidos(pedidos) {
    const response = await axiosClient.get('/api/pedidos');
    pedidos.value = Object.values(response.data).map(pedido => ({
        numero: pedido['id'],
        nome_cliente: pedido['nome_cliente'],
        observacao: pedido['observacao'],
        status: pedido['status'],
        tipo_entrega: pedido['tipo_entrega'],
        total: pedido['total'],
        items: pedido.items.map(item => ({
            tamanho: item['size_id'],
            quantidade: item['quantidade'],
            creme: item['creme_id'],
            recheio: item['recheio_id'],
            acompanhamento: item['acompanhamento_id'],
            cobertura: item['cobertura_id'],
        })),
        entrega: pedido['delivery'],
    }));
}

export {getTamanhos, getCremes, getRecheios, getAcompanhamentos, getCoberturas, getPedidos};