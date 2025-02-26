import {defineStore} from "pinia";
import axiosClient from "../axios.js";

const useOrderStore = defineStore('order', {
    state: () => ({
        orders: []
    }),
    actions: {
        async fetchOrders() {
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