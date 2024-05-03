<template>
    <div id="page-media-admin">
        <PageHeader title="Media Admin">Manage media files</PageHeader>

        <div class="text-white mb-5">
            <div class="mb-5">
                <div class="flex flex-row gap-2 justify-end mb-5">
                    <ButtonText v-if="list_delete_selected.length" v-on:click="deleteSelectedFiles">
                        Delete Files
                    </ButtonText>
                    <ButtonText v-on:click="openFileBrowser">Upload images</ButtonText>
                    <ButtonLink v-if="store.logged_in" url="/timeline-admin">Timeline Admin</ButtonLink>
                </div>
                <input type="file" multiple class="hidden" v-on:change="queueFiles" ref="fileUpload">
            </div>
            <div v-if="'object' === typeof list.directories" class="sm:flex sm:flex-row sm:gap-2">
                <div class="mb-4">
                    <div class="bg-[#151f1d] rounded-t-md text-center font-semibold">
                        <div class="px-2 py-1">Directories</div>
                    </div>
                    <router-link
                        v-for="(entry, idx) in list.directories"
                        :class="{
                            'block': true,
                            'bg-[#151f1d]': true,
                            'border-t': true,
                            'border-[#1f2e2b]': true,
                            'rounded-b-md': idx === list.directories.length - 1
                        }"
                        :to="getDirectoryLink(entry)"
                    >
                        <div class="px-2 py-1">{{ entry }}</div>
                    </router-link>
                </div>
                <div class="grow mb-4">
                    <div class="bg-[#151f1d] rounded-t-md text-center font-semibold">
                        <div class="px-2 py-1">Images</div>
                    </div>
                    <ul
                        v-if="list.files.length"
                        class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-2 bg-[#151f1d] border-t border-[#1f2e2b] rounded-b-md p-2"
                    >
                        <li v-for="(entry, idx) in list.files">
                            <div class="relative cursor-pointer" v-on:click="toggleListSelect(idx)">
                                <div
                                    v-if="-1 !== list_delete_selected.indexOf(idx)"
                                    class="absolute top-2 left-2 rounded-[50%] bg-teal-600/65"
                                >
                                    <CheckIcon class="w-6 h-6" />
                                </div>
                                <img :src="getImageLink(entry)" :alt="entry" :title="entry">
                            </div>
                        </li>
                    </ul>
                    <div
                        v-if="!list.files.length"
                        class="bg-[#151f1d] border-t border-[#1f2e2b] rounded-b-md px-2 py-1"
                    >
                        <p>No images</p>
                    </div>
                </div>
            </div>
            <div v-if="'undefined' === typeof list.directories">
                <p>Loading...</p>
            </div>
        </div>

        <Modal :show="showUploadDialog" title="Uploading images...">
            <div class="flex flex-col gap-4">
                <div v-for="file in uploads">
                    <div class="flex">
                        <div class="my-auto w-16 mr-2">
                            <img v-if="file.image" :src="file.image" alt="Upload preview">
                        </div>
                        <div class="flex-grow my-auto">
                            <p class="mb-2">{{ file.name }}</p>
                            <ProgressBar :progress="file.uploaded" />
                        </div>
                    </div>
                </div>
            </div>
        </Modal>
    </div>
</template>

<script setup>
import { CheckIcon } from '@heroicons/vue/24/outline';
import { onMounted, ref } from 'vue';
import { onBeforeRouteUpdate, useRoute } from 'vue-router';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonLink from '../components/button-link';
import ButtonText from '../components/button-text';
import Modal from '../components/modal';
import PageHeader from '../components/page-header';
import ProgressBar from '../components/progress-bar';
import useDefaultStore from '../store';

const fileUpload = ref(null);
const last_upload_idx = ref(-1);
const list = ref({});
const list_delete_selected = ref([]);
const route = useRoute();
const runningUploads = ref(0);
const showUploadDialog = ref(false);
const store = useDefaultStore();
const uploads = ref([]);

onBeforeRouteUpdate((to, from) => {
    if (from.params.path === to.params.path) {
        return;
    }

    loadList(to.params.path);
});

onMounted(() => {
    loadList(route.params.path);

    store.setBackUrl('/timeline-admin');
});

/**
 * Submit the request to delete all selected files.
 */
function deleteSelectedFiles() {
    let data = new FormData();

    for (let i = 0; i < list_delete_selected.value.length; i++) {
        data.append('files[]', route.params.path + '/' + list.value.files[list_delete_selected.value[i]]);
    }

    (new AjaxRequest('POST', '/media-delete', data))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response) {
                return;
            }

            list_delete_selected.value = [];
            loadList(route.params.path);
        })
        .send();
}

function getDirectoryLink(name) {
    if ('..' === name) {
        return '/media-admin' + route.params.path.replace(/\/[^\/]+$/, '')
    }

    return '/media-admin' + route.params.path + name;
}

function getImageLink(file) {
    return route.params.path + '/' + file;
}

function loadList(path) {
    let data = new FormData();
    data.append('path', path);

    list.value = {};
    (new AjaxRequest('POST', '/media-list', data))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response) {
                return;
            }

            list.value = response.list;
        })
        .send();
}

/**
 * Open the file browser on the file element.
 */
function openFileBrowser() {
    fileUpload.value.click();
}

/**
 * Queue all files from the browser.
 */
function queueFiles() {
    for (let f = 0; f < fileUpload.value.files.length; f++) {
        let upload = {
            'file': fileUpload.value.files[f],
            'image': '',
            'name': fileUpload.value.files[f].name,
            'reader': new FileReader(),
            'uploaded': '0%'
        };
        uploads.value.push(upload);

        let idx = uploads.value.length -1;
        uploads.value[idx].reader.onloadend = (e) => {
            uploads.value[idx].image = e.target.result;
        };
        uploads.value[idx].reader.readAsDataURL(fileUpload.value.files[f]);
    }

    showUploadDialog.value = true;
    uploadFiles();
}

/**
 * Toggle the select status of a file.
 *
 * @param {Integer} idx
 */
function toggleListSelect(idx) {
    let delete_idx = list_delete_selected.value.indexOf(idx);
    if (-1 === delete_idx) {
        list_delete_selected.value.push(idx);
    } else {
        list_delete_selected.value.splice(delete_idx, 1);
    }
}

/**
 * Upload the file with the given index from the uploads array.
 *
 * @param {Integer} file_idx
 */
function uploadFile(file_idx) {
    let data = new FormData();
    data.append('path', route.params.path);
    data.append('file', uploads.value[file_idx].file);

    (new AjaxRequest('POST', '/media-upload', data))
        .uploadProgress((event) => {
            uploads.value[file_idx].uploaded = Math.round(100 * event.loaded / event.total) + '%';
        })
        .done((response) => {
            if ('object' !== typeof response) {
                return;
            }

            runningUploads.value -= 1;
            uploadFiles();
            if (0 === runningUploads.value) {
                loadList(route.params.path);
                showUploadDialog.value = false;
            }
        })
        .send();

    runningUploads.value += 1;
}

/**
 * Upload files, as long as there are files available, it will only upload 3 files simultaneously.
 */
function uploadFiles() {
    if (3 <= runningUploads.value) {
        return;
    }

    last_upload_idx.value++;
    if (last_upload_idx.value >= uploads.value.length) {
        return;
    }

    uploadFile(last_upload_idx.value);

    uploadFiles();
}
</script>
