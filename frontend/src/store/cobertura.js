import {defineStore} from "pinia";
import axiosClient from "../axios.js";

const useCoberturaStore = defineStore('cobertura', {
    state: () => ({
        coberturas: []
    }),
    actions: {
        async fetchCoberturas() {
            try {
                const response = await axiosClient.get('/api/coberturas');
                this.coberturas = Object.values(response.data).map(cobertura => ({
                    id: cobertura["id"],
                    name: cobertura["nome"],
                    status: cobertura["status"],
                }))
            } catch (error) {
                console.error(error);
            }
        },

        async addCobertura(data) {
            try {
                const response = await axiosClient.post('/api/coberturas', {nome: data.cobertura.nome})
                if (response.status === 201) {
                    alert('Cobertura adicionado com sucesso!');
                    await this.fetchCoberturas()
                } else {
                    alert('Erro ao adicionar cobertura');
                }
            } catch (error) {
                console.error('Falha ao adicionar cobertura', error);
            }
        },

        async update_cobertura(cobertura) {
            try {
                const response = await axiosClient.put(`/api/coberturas/${cobertura.id}`, {
                    status: cobertura.status === 'ativo' ? 'inativo' : 'ativo'
                });
                const coberturaData = response.data;
                this.coberturas = this.coberturas.map(c => c.id === cobertura.id ? {...c, status: coberturaData.status} : c);
            } catch (error) {
                console.error(error);
            }
        },

        async delete_cobertura(cobertura) {
            try {
                if (!confirm('Deseja realmente excluir essa cobertura?')) return;
                await axiosClient.delete(`/api/coberturas/${cobertura.id}`);
                this.coberturas = this.coberturas.filter(c => c.id !== cobertura.id);
            } catch (error) {
                console.error(error);
            }
        }
    }
})

export default useCoberturaStore;