<template>
    <div class="media-list">
        <div v-if="directories.length" class="sm:flex sm:flex-row sm:gap-2">
            <div class="mb-4">
                <div class="bg-[#151f1d] rounded-t-md text-center font-semibold">
                    <div class="px-2 py-1">Directories</div>
                </div>
                <div
                    v-for="(entry, idx) in directories"
                    :class="{
                        'block': true,
                        'bg-[#151f1d]': true,
                        'border-t': true,
                        'border-[#1f2e2b]': true,
                        'rounded-b-md': idx === directories.length - 1,
                        'cursor-pointer': true
                    }"
                    v-on:click="$emit('directory-selected', getDirectoryLink(entry))"
                >
                    <div class="px-2 py-1">{{ entry }}</div>
                </div>
            </div>
            <div class="grow mb-4">
                <div class="bg-[#151f1d] rounded-t-md text-center font-semibold">
                    <div class="px-2 py-1">Images</div>
                </div>
                <ul
                    v-if="files.length"
                    class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-2 bg-[#151f1d] border-t border-[#1f2e2b] rounded-b-md p-2"
                >
                    <li v-for="entry in files">
                        <div class="relative cursor-pointer" v-on:click="toggleListSelect(getImageLink(entry))">
                            <div
                                v-if="-1 !== mediaAdminStore.selected_files.indexOf(getImageLink(entry))"
                                class="absolute top-2 left-2 rounded-[50%] bg-teal-600/65"
                            >
                                <CheckIcon class="w-6 h-6" />
                            </div>
                            <img :src="getImageLink(entry)" :alt="entry" :title="entry">
                        </div>
                    </li>
                </ul>
                <div
                    v-if="!files.length"
                    class="bg-[#151f1d] border-t border-[#1f2e2b] rounded-b-md px-2 py-1"
                >
                    <p>No images</p>
                </div>
            </div>
        </div>
        <div v-if="!directories.length">
            <p>Loading...</p>
        </div>
    </div>
</template>

<script setup>
import { CheckIcon } from '@heroicons/vue/24/outline';
import useMediaAdminStore from '../stores/media-admin';

defineEmits(['directory-selected']);
const mediaAdminStore = useMediaAdminStore();
const props = defineProps({
    'directories': {
        'type': Array,
        'required': true,
    },
    'files': {
        'type': Array,
        'required': true,
    },
    'path': {
        'type': String,
        'required': true,
    },
});

/**
 * Returns the link to the directory from the filename.
 *
 * @param {string} name
 * @returns {string}
 */
function getDirectoryLink(name) {
    if ('..' === name) {
        return props.path.replace(/\/[^\/]+$/, '')
    }

    return props.path + name;
}

/**
 * Returns the link to the image from the filename.
 *
 * @param {string} file
 * @returns {string}
 */
function getImageLink(file) {
    return props.path + '/' + file;
}

/**
 * Toggle the select status of a file.
 *
 * @param {String} file
 */
function toggleListSelect(file) {
    if (-1 === mediaAdminStore.selected_files.indexOf(file)) {
        mediaAdminStore.addFile(file);
    } else {
        mediaAdminStore.removeFile(file);
    }
}
</script>
