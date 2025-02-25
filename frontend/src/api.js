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
    cremes.value = Object.values(response.data).map(creme => ({
        id: creme["id"],
        name: creme["nome"],
        status: creme["status"],
    }));
}

async function getRecheios(recheios) {
    const response = await axiosClient.get('/api/recheios');
    recheios.value = Object.values(response.data).map(recheio => ({
        name: recheio["nome"],
        status: recheio["status"],
    }));
}

async function getAcompanhamentos(acompanhamentos) {
    const response = await axiosClient.get('/api/acompanhamentos');
    acompanhamentos.value = Object.values(response.data).map(acompanhamento => ({
        name: acompanhamento["nome"],
        status: acompanhamento["status"],
    }));
}

async function getCoberturas(coberturas) {
    const response = await axiosClient.get('/api/coberturas');
    coberturas.value = Object.values(response.data).map(cobertura => ({
        name: cobertura["nome"],
        status: cobertura["status"],
    }));
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
    }));
}

async function getEntregas(entregas) {
    const response = await axiosClient.get('/api/deliveries');
    entregas.value = Object.values(response.data).map(entrega => ({
        pedido: entrega['id'],
        nome_cliente: entrega['delivery']['nome_cliente'],
        telefone_cliente: entrega['delivery']['telefone_cliente'],
        rua: entrega['delivery']['rua'],
        bairro: entrega['delivery']['bairro'],
        numero: entrega['delivery']['numero'],
        referencia: entrega['delivery']['referencia'],
        forma_pagamento: entrega['delivery']['forma_pagamento'],
        troco: entrega['delivery']['troco'] ? 'Sim' : 'Não',
        troco_para: entrega['delivery']['troco'] ? entrega['delivery']['troco_para'] : 0,
    }));
}




export {getTamanhos, getCremes, getRecheios, getAcompanhamentos, getCoberturas, getPedidos, getEntregas};