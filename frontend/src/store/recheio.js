import {defineStore} from "pinia";
import axiosClient from "../axios.js";

const useRecheioStore = defineStore('recheio', {
    state: () => ({
        recheios: []
    }),
    actions: {
        async fetchRecheios() {
            try {
                const response = await axiosClient.get('/api/recheios');
                this.recheios = response.data;
            } catch (error) {
                console.error('Erro ao carregar recheios', error);
                throw error;
            }
        },

        async addRecheio(data) {
            try {
                const response = await axiosClient.post('/api/recheios', {nome: data.recheio.nome})
                if (response.status === 201) {
                    alert('Recheio adicionado com sucesso!');
                    await this.fetchRecheios()
                } else {
                    alert('Erro ao adicionar recheio');
                }
            } catch (error) {
                console.error('Falha ao adicionar recheio', error);
            }
        },

        async update_recheio(recheio) {
            try {
                const response = await axiosClient.put(`/api/recheios/${recheio.id}`, {
                    status: recheio.status === 'ativo' ? 'inativo' : 'ativo'
                });
                const recheioData = response.data;
                this.recheios = this.recheios.map(r => r.id === recheio.id ? {...r, status: recheioData.status} : r);
            } catch (error) {
                console.error(error);
            }
        },

        async delete_recheio(recheio) {
            if (!confirm('Deseja realmente excluir esse recheio?')) return;
            try {
                await axiosClient.delete(`/api/recheios/${recheio.id}`);
                this.recheios = this.recheios.filter(r => r.id !== recheio.id);
            } catch (error) {
                console.error(error);
            }
        }
    }
});

export default useRecheioStore;