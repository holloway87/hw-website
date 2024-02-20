<template>
    <div class="project-photos-gallery">
        <p v-if="null === files" class="text-white mb-4">Loading...</p>
        <p v-if="null !== files && !files.length" class="text-white mb-4">There was an error loading the photos.</p>
        <PhotosGallery v-if="null !== files && files.length" class="gallery-columns-3" :files="files" />
    </div>
</template>

<script>
import { AjaxRequest } from '../lib/ajax-request';
import PhotosGallery from './photos-gallery';
import VuePictureSwipe from 'vue-picture-swipe';

export default {
    components: { PhotosGallery, VuePictureSwipe },
    data() {
        return {
            'files': [],
        };
    },
    mounted() {
        let data = new FormData();
        data.append('project', this.project);

        let request = new AjaxRequest('POST', '/photos/get-files', data);
        request.send((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response || !response.success) {
                this.files = [];

                return;
            }

            this.files = response.files;
        });
    },
    props: {
        'project': {
            'required': true,
            'type': String,
        },
    },
};
</script>
