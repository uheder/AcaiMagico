import {defineStore} from "pinia";
import axiosClient from "../axios.js";

const useAcompanhamentoStore = defineStore('acompanhamento', {
    state: () => ({
        acompanhamentos: []
    }),
    actions: {
        async fetchAcompanhamentos() {
            try {
                const response = await axiosClient.get('/api/acompanhamentos');
                this.acompanhamentos = Object.values(response.data).map(acompanhamento => ({
                    id: acompanhamento["id"],
                    name: acompanhamento["nome"],
                    status: acompanhamento["status"],
                }))
            } catch (error) {
                console.error(error);
            }
        },

        async update_acompanhamento(acompanhamento) {
            try {
                const response = await axiosClient.put(`/api/acompanhamentos/${acompanhamento.id}`, {
                    status: acompanhamento.status === 'ativo' ? 'inativo' : 'ativo'
                });
                const acompanhamentoData = response.data;
                this.acompanhamentos = this.acompanhamentos.map(c => c.id === acompanhamento.id ? {...c, status: acompanhamentoData.status} : c);
            } catch (error) {
                console.error(error);
            }
        },

        async delete_acompanhamento(acompanhamento) {
            try {
                if (!confirm('Deseja realmente excluir esse acompanhamento?')) return;
                await axiosClient.delete(`/api/acompanhamentos/${acompanhamento.id}`);
                this.acompanhamentos = this.acompanhamentos.filter(c => c.id !== acompanhamento.id);
            } catch (error) {
                console.error(error);
            }
        }
    }
})

export default useAcompanhamentoStore;