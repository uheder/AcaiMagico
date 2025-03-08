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
                this.sizes = response.data
            } catch (error) {
                console.error(error);
            }
        },

        async addSize(data) {
            try {
                const response = await axiosClient.post('/api/sizes', {
                    nome: data.nome,
                    valor: data.valor,
                    max_cremes: data.max_cremes,
                    max_recheios: data.max_recheios,
                    max_acompanhamentos: data.max_acompanhamentos,
                    max_coberturas: data.max_coberturas
                })

                if (response.status === 201) {
                    alert('Tamanho adicionado com sucesso!');
                    await this.fetchSizes()
                } else {
                    alert(response.data.errors)
                }

            } catch (error) {
                console.error('Erro ao criar um novo tamanho', error);
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