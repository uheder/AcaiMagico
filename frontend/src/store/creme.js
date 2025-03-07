import {defineStore} from "pinia";
import axiosClient from "../axios.js";

const useCremeStore = defineStore('creme', {
    state: () => ({
        cremes: []
    }),
    actions: {
        async fetchCremes() {
            try {
                const response = await axiosClient.get('/api/cremes');
                this.cremes = Object.values(response.data).map(creme => ({
                    id: creme["id"],
                    name: creme["nome"],
                    status: creme["status"],
                }))
            } catch (error) {
                console.error(error);
            }
        },

        async addCreme(data) {
            try {
                const response = await axiosClient.post('/api/cremes', {nome: data.creme.nome})
                if (response.status === 201) {
                    alert('Creme adicionado com sucesso!');
                    await this.fetchCremes()
                } else {
                    alert('Erro ao adicionar creme');
                }
            } catch (error) {
                console.error('Falha ao adicionar creme', error);
            }
        },

        async update_creme(creme) {
            try {
                const response = await axiosClient.put(`/api/cremes/${creme.id}`, {
                    status: creme.status === 'ativo' ? 'inativo' : 'ativo'
                });
                const cremeData = response.data;
                this.cremes = this.cremes.map(c => c.id === creme.id ? {...c, status: cremeData.status} : c);
            } catch (error) {
                console.error(error);
            }
        },

        async delete_creme(creme) {
            if (!confirm('Deseja realmente excluir esse creme?')) return;
            try {
                await axiosClient.delete(`/api/cremes/${creme.id}`);
                this.cremes = this.cremes.filter(c => c.id !== creme.id);
            } catch (error) {
                console.error(error);
            }
        }
    }
})

export default useCremeStore;