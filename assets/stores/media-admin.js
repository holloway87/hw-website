import { defineStore } from 'pinia';

const useMediaAdminStore = defineStore('media-admin', {
    state: () => ({
        selected_files: [],
    }),
    actions: {
        addFile(file) {
            this.selected_files.push(file);
        },
        removeFile(file) {
            let idx = this.selected_files.findIndex((element) => file === element);
            if (-1 !== idx) {
                this.selected_files.splice(idx, 1);
            }
        },
        resetFiles() {
            this.selected_files.length = 0;
        }
    },
});

export default useMediaAdminStore;
