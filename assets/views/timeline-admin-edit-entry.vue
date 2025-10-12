<template>
    <div id="page-timeline-admin-edit-entry">
        <PageHeader title="Timeline Admin - Edit entry">
            <span v-if="timeline_entry">{{ timeline_entry.date }} {{ timeline_entry.time }}</span>
        </PageHeader>

        <p v-if="!timeline_entry" class="text-text text-center mb-4">Loading...</p>
        <div v-if="timeline_entry" class="bg-widget rounded-md shadow-md p-4 mb-4">
            <div class="sm:grid sm:grid-cols-2 sm:gap-3">
                <div>
                    <div class="mb-4">
                        <label class="font-400 text-text block mb-1">Title</label>
                        <input
                            type="text"
                            class="border border-2 border-text-shadow px-2 py-1 outline-hidden rounded-md shadow-md bg-text text-widget w-full"
                            v-model="timeline_entry.title"
                        >
                    </div>
                    <div class="mb-4">
                        <label class="font-400 text-text block mb-1">Content</label>
                        <textarea
                            type="text"
                            class="border border-2 border-text-shadow px-2 py-1 outline-hidden rounded-md shadow-md bg-text text-widget w-full"
                            rows="10"
                            v-model="timeline_entry.content"
                        ></textarea>
                    </div>
                </div>
                <div>
                    <div class="mb-4">
                        <label class="font-400 text-text block mb-1">Images</label>
                        <ul class="flex flex-row gap-3">
                            <li v-for="(image, idx) in timeline_entry.images">
                                <img :src="image.thumbnail" :alt="'Image ' + (idx + 1)">
                            </li>
                        </ul>
                        <p v-if="!timeline_entry.images.length" class="text-text">No images</p>
                    </div>
                    <div class="mb-4">
                        <ButtonText v-on:click="chooseImages">Choose images</ButtonText>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div>
                    <ButtonText v-on:click="submitForm">
                        Save
                    </ButtonText>
                </div>
                <div class="text-right">
                    <ButtonText variant="error" v-on:click="deleteEntry">
                        Delete
                    </ButtonText>
                </div>
            </div>
        </div>

        <Modal :show="showChooseImagesDialog" title="Choose images" size="4xl">
            <MediaList :path="mediaPath" :files="mediaList.files" :directories="mediaList.directories" v-on:directory-selected="loadMediaDirectory" />
            <div class="mt-4">
                <ButtonText v-on:click="closeChooseImagesDialog">Done</ButtonText>
            </div>
        </Modal>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonText from '../components/button-text';
import Modal from '../components/modal';
import MediaList from '../components/media-list';
import PageHeader from '../components/page-header';
import useDefaultStore from '../stores/default';
import useMediaAdminStore from '../stores/media-admin';

const route = useRoute();
const router = useRouter();
const store = useDefaultStore();
const mediaAdminStore = useMediaAdminStore();
const mediaList = ref({
    'directories': [],
    'files': [],
});
const mediaPath = ref('');
const showChooseImagesDialog = ref(false);
const timeline_entry = ref(null);

onMounted(() => {
    let data = new FormData();
    data.append('id', route.params.id);
    data.append('includeEmpty', '1');

    (new AjaxRequest('POST', '/timeline/entries', data))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response || !response.success) {
                return;
            }

            if (1 === response.entries.length) {
                timeline_entry.value = response.entries[0];
            }
        })
        .send();

    store.setBackUrl('/timeline-admin');
});

/**
 * Show the choose images modal and select all images currently registered.
 */
function chooseImages() {
    mediaAdminStore.resetFiles();
    for (let i = 0; i < timeline_entry.value.images.length; i++) {
        mediaAdminStore.addFile(timeline_entry.value.images[i].src);
    }
    loadMediaList(mediaPath.value);
    showChooseImagesDialog.value = true;
}

/**
 * Close the choose images dialog and save all selected images to the timeline entry.
 */
function closeChooseImagesDialog() {
    timeline_entry.value.images = [];
    for (let i = 0; i < mediaAdminStore.selected_files.length; i++) {
        timeline_entry.value.images.push({
            'src': mediaAdminStore.selected_files[i],
            'thumbnail': mediaAdminStore.selected_files[i],
        });
    }
    showChooseImagesDialog.value = false;
}

/**
 * Deletes the entry.
 */
function deleteEntry() {
    (new AjaxRequest('POST', '/timeline-admin/delete-' + timeline_entry.value.id))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if (response.message) {
                return;
            }

            if (!response.success) {
                return;
            }

            router.push('/timeline-admin');
        })
        .send();
}

/**
 * Set the new path and load the directories and files for it.
 *
 * @param {string} path
 */
function loadMediaDirectory(path) {
    mediaPath.value = path;
    loadMediaList(path);
}

/**
 * Load all directories and files for the path.
 *
 * @param {string} path
 */
function loadMediaList(path) {
    let data = new FormData();
    data.append('path', path);

    mediaList.value = {
        'directories': [],
        'files': [],
    };
    (new AjaxRequest('POST', '/media-list', data))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response) {
                return;
            }

            mediaList.value = response.list;
        })
        .send();
}

/**
 * Submits the timeline entry data to save it.
 */
function submitForm() {
    let data = new FormData();
    data.append('title', timeline_entry.value.title ?? '');
    data.append('content', timeline_entry.value.content ?? '');
    for (let i = 0; i < timeline_entry.value.images.length; i++) {
        data.append('images[]', timeline_entry.value.images[i].src);
    }

    (new AjaxRequest('POST', '/timeline-admin/edit-' + timeline_entry.value.id, data))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if (response.message) {
                return;
            }

            if (!response.success) {
                return;
            }

            router.push('/timeline-admin');
        })
        .send();
}
</script>
