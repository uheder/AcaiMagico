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
                this.recheios = Object.values(response.data).map(recheio => ({
                    id: recheio["id"],
                    name: recheio["nome"],
                    status: recheio["status"],
                }));
            } catch (error) {
                console.error(error);
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