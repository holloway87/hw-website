<template>
    <div class="project-photos-gallery">
        <p v-if="loading" class="text-white mb-4">Loading...</p>
        <p v-if="!loading && !files.length" class="text-white mb-4">There was an error loading the photos.</p>
        <PhotosGallery v-if="files.length" class="gallery-columns-3" :files="files" />
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { AjaxRequest } from '../lib/ajax-request';
import PhotosGallery from './photos-gallery';

const files = ref([]);
const loading = ref(true);
const props = defineProps({
    'project': {
        'required': true,
        'type': String,
    },
});

onMounted(() => {
    let data = new FormData();
    data.append('project', props.project);

    (new AjaxRequest('POST', '/photos/get-files', data))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response || !response.success) {
                files.value = [];

                return;
            }

            files.value = response.files;
            loading.value = false;
        })
        .send();
});
</script>
