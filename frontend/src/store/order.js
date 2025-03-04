import {defineStore, storeToRefs} from "pinia";
import axiosClient from "../axios.js";
import useCartStore from "./cart.js";
import {toRaw} from "vue";

const useOrderStore = defineStore('order', {
    state: () => ({
        orders: [],
    }),
    actions: {
        async fetchOrders() {
            console.log(toRaw(useCartStore().cart))
            try {
                const response = await axiosClient.get('/api/orders');
                this.orders = Object.values(response.data).map(order => ({
                    numero: order['id'],
                    nome_cliente: order['nome_cliente'],
                    observacao: order['observacao'],
                    total: order['total'],
                    status: order['status'],
                    items: order.items.map(item => ({
                        tamanho: item['size_id'],
                        quantidade: item['quantidade'],
                        cremes: item['creme'].map(creme => creme['nome'] ?? 'Sem creme'),
                        recheios: item['recheio'].map(recheio => recheio['nome']?? 'Sem recheio'),
                        acompanhamentos: item['acompanhamento'].map(acompanhamento => acompanhamento['nome'] ?? 'Sem acompanhamento'),
                        coberturas: item['cobertura'].map(cobertura => cobertura['nome']?.length > 0 ? cobertura['nome'] : ['Sem cobertura']),
                    })),
                    tipo_entrega: order['tipo_entrega'],
                }))
            } catch (error) {
                console.error(error);
            }
        },

        async getOrder(id) {
            try {
                const response = await axiosClient.get(`/api/orders/${id}`);
                return response.data;
            } catch (error) {
                console.error('Erro ao procurar pedido', error);
            }
        },

        async createOrder(client_info) {
          const response = await axiosClient.post('/api/orders', {
              nome_cliente: client_info.nome_cliente,
              observacao: client_info.observacao,
              tipo_entrega: client_info.tipo_entrega,
              telefone_cliente: client_info.tipo_entrega === 'Entrega' ? client_info.telefone_cliente : null,
              rua: client_info.tipo_entrega === 'Entrega' ? client_info.rua : null,
              bairro: client_info.tipo_entrega === 'Entrega' ? client_info.bairro : null,
              numero: client_info.tipo_entrega === 'Entrega' ? client_info.numero : null,
              referencia: client_info.tipo_entrega === 'Entrega' ? client_info.referencia : null,
              forma_pagamento: client_info.tipo_entrega === 'Entrega' ?client_info.forma_pagamento : null,
              troco: client_info.tipo_entrega === 'Entrega' ? client_info.forma_pagamento === 'Dinheiro' ? client_info.troco : false : false,
              troco_para: client_info.tipo_entrega === 'Entrega' ? client_info.forma_pagamento === 'Dinheiro' ? client_info.troco ? client_info.troco_para: 0 : 0 : 0,
              items: useCartStore().cart.map(item => ({
                  size_id: item.tamanho.id,
                  quantidade: item.quantidade,
                  creme: item.creme.map(creme => creme.id),
                  recheio: item.recheio.map(recheio => recheio.id),
                  acompanhamento: item.acompanhamento.map(acompanhamento => acompanhamento.id),
                  cobertura: item.cobertura.map(cobertura => cobertura.id),
              })),
          });
        },

        async updateOrderStatus(order, status) {
            try {
                const response = await axiosClient.put(`/api/orders/${order.id}`, {
                    status: status
                });
                const orderData = response.data
                this.orders = this.orders.map(o => o.id === order.id ? {...o, status: orderData.status} : o);
            } catch (error) {
                console.error(error);
            }
        },

        async deleteOrder(order) {
            if (!confirm('Deseja realmente excluir esse pedido?')) return;
            try {
                await axiosClient.delete(`/api/orders/${order.id}`);
                this.orders = this.orders.filter(o => o.id !== order.id);
            } catch (error) {
                console.error(error);
            }
        }
    }
})

export default useOrderStore;