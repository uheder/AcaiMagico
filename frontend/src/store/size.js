import {defineStore} from "pinia";
import axiosClient from "../axios.js";

const useSizeStore = defineStore('size', {
    state: () => ({
        sizes: []
    }),
    actions: {
        async fetchSizes() {
            try {
                const response = await axiosClient.get('/api/sizes');
                this.sizes = Object.values(response.data).map(size => ({
                    id: size.id,
                    nome: size.nome,
                    valor: size.valor,
                    qtd_cremes: size.max_cremes,
                    qtd_recheios: size.max_recheios,
                    qtd_acompanhamentos: size.max_acompanhamentos,
                    qtd_coberturas: size.max_coberturas,
                    status: size.status,
                }));
            } catch (error) {
                console.error(error);
            }
        },

        async update_size(size) {
            try {
                const response = await axiosClient.put(`/api/sizes/${size.id}`, {
                    status: size.status === 'ativo' ? 'inativo' : 'ativo'
                });
                const sizeData = response.data;
                this.sizes = this.sizes.map(s => s.id === size.id ? {...s, status: sizeData.status} : s);
            } catch (error) {
                console.error(error);
            }
        },

        async delete_size(size) {
            try {
                if (!confirm('Deseja realmente excluir esse tamanho de açai?')) return;
                await axiosClient.delete(`/api/sizes/${size.id}`);
                this.sizes = this.sizes.filter(s => s.id !== size.id);
            } catch (error) {
                console.error(error);
            }
        }
    }
});

export default useSizeStore;