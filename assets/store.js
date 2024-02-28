import { defineStore } from 'pinia';

const logged_in = '1' === localStorage.getItem('logged_in');

const useDefaultStore = defineStore('default', {
    state: () => ({
        back_url: '',
        logged_in: logged_in,
    }),
    actions: {
        setBackUrl(url) {
            this.back_url = url;
        },
        setLoggedIn(state) {
            this.logged_in = state;
            localStorage.setItem('logged_in', state ? '1' : '0');
        },
    },
});

export default useDefaultStore;
