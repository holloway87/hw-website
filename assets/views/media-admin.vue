<template>
    <div id="page-media-admin">
        <PageHeader title="Media Admin">Manage media files</PageHeader>

        <div class="text-text mb-5">
            <div class="mb-5">
                <div class="flex flex-row gap-2 justify-end mb-5">
                    <ButtonText v-if="mediaAdminStore.selected_files.length" v-on:click="deleteSelectedFiles">
                        Delete Files
                    </ButtonText>
                    <MediaUploader :path="route.params.path" v-on:uploads-complete="loadList(route.params.path)" />
                    <ButtonLink v-if="store.logged_in" url="/timeline-admin">Timeline Admin</ButtonLink>
                </div>
            </div>
            <MediaList :path="route.params.path" :files="list.files" :directories="list.directories" v-on:directory-selected="(path) => router.push('/media-admin' + path)" />
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { onBeforeRouteUpdate, useRoute, useRouter } from 'vue-router';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonLink from '../components/button-link';
import ButtonText from '../components/button-text';
import MediaList from '../components/media-list';
import MediaUploader from '../components/media-uploader';
import PageHeader from '../components/page-header';
import useDefaultStore from '../stores/default';
import useMediaAdminStore from '../stores/media-admin';

const list = ref({
    'directories': [],
    'files': [],
});
const route = useRoute();
const router = useRouter();
const store = useDefaultStore();
const mediaAdminStore = useMediaAdminStore();

onBeforeRouteUpdate((to, from) => {
    if (from.params.path === to.params.path) {
        return;
    }

    mediaAdminStore.resetFiles();
    loadList(to.params.path);
});

onMounted(() => {
    mediaAdminStore.resetFiles();
    loadList(route.params.path);

    store.setBackUrl('/timeline-admin');
});

/**
 * Submit the request to delete all selected files.
 */
function deleteSelectedFiles() {
    let data = new FormData();

    for (let i = 0; i < mediaAdminStore.selected_files.length; i++) {
        data.append('files[]', mediaAdminStore.selected_files[i]);
    }

    (new AjaxRequest('POST', '/media-delete', data))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response) {
                return;
            }

            mediaAdminStore.resetFiles();
            loadList(route.params.path);
        })
        .send();
}

function loadList(path) {
    let data = new FormData();
    data.append('path', path);

    list.value = {
        'directories': [],
        'files': [],
    };
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
</script>
