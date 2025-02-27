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
                }))
            } catch (error) {
                console.error(error);
            }
        }
    }
});
export default useSizeStore;