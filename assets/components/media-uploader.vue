<template>
    <div class="media-uploader">
        <ButtonText v-on:click="openFileBrowser">Upload images</ButtonText>
        <input type="file" multiple class="hidden" v-on:change="queueFiles" ref="fileUpload">

        <Modal :show="showUploadDialog" title="Uploading images...">
            <div class="flex flex-col gap-4">
                <div v-for="file in uploads">
                    <div class="flex">
                        <div class="my-auto w-16 mr-2">
                            <img v-if="file.image" :src="file.image" alt="Upload preview">
                        </div>
                        <div class="grow my-auto">
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
import { ref } from 'vue';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonText from './button-text';
import Modal from './modal';
import ProgressBar from './progress-bar';

const emit = defineEmits(['uploads-complete']);
const fileUpload = ref(null);
const last_upload_idx = ref(-1);
const props = defineProps({
    'path': {
        'type': String,
        'required': true,
    },
});
const runningUploads = ref(0);
const showUploadDialog = ref(false);
const uploads = ref([]);

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
 * Upload the file with the given index from the uploads array.
 *
 * @param {int} file_idx
 */
function uploadFile(file_idx) {
    let data = new FormData();
    data.append('path', props.path);
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
            if (0 === runningUploads.value) {
                uploads.value.length = 0;
                last_upload_idx.value = -1;
                emit('uploads-complete');
                showUploadDialog.value = false;

                return;
            }

            uploadFiles();
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
