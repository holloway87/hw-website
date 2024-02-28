import { defineStore } from 'pinia';

const useDefaultStore = defineStore('default', {
    state: () => ({
        back_url: ''
    }),
    actions: {
        setBackUrl(url) {
            this.back_url = url;
        },
    },
});

export default useDefaultStore;
