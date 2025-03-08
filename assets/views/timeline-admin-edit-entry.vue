<template>
    <div id="page-timeline-admin-edit-entry">
        <PageHeader title="Timeline Admin - Edit entry">
            <span v-if="timeline_entry">{{ timeline_entry.date }} {{ timeline_entry.time }}</span>
        </PageHeader>

        <p v-if="!timeline_entry" class="text-white text-center mb-4">Loading...</p>
        <div v-if="timeline_entry">
            <div class="sm:grid sm:grid-cols-2 sm:gap-3">
                <div>
                    <div class="mb-4">
                        <label class="font-400 text-white block mb-1">Title</label>
                        <input
                            type="text"
                            class="border border-[#151f1d] px-2 py-1 outline-hidden rounded-md bg-white text-black w-full"
                            v-model="timeline_entry.title"
                        >
                    </div>
                    <div class="mb-4">
                        <label class="font-400 text-white block mb-1">Content</label>
                        <textarea
                            type="text"
                            class="border border-[#151f1d] px-2 py-1 outline-hidden rounded-md bg-white text-black w-full"
                            rows="10"
                            v-model="timeline_entry.content"
                        ></textarea>
                    </div>
                </div>
                <div>
                    <div class="mb-4">
                        <label class="font-400 text-white block mb-1">Images</label>
                        <ul class="flex flex-row gap-3">
                            <li v-for="(image, idx) in timeline_entry.images">
                                <img :src="image.thumbnail" :alt="'Image ' + (idx + 1)">
                            </li>
                        </ul>
                        <p v-if="!timeline_entry.images.length" class="text-white">No images</p>
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
                    <ButtonText class="bg-red-700" v-on:click="deleteEntry">
                        Delete
                    </ButtonText>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonText from '../components/button-text';
import PageHeader from '../components/page-header';
import useDefaultStore from '../store';

const route = useRoute();
const router = useRouter();
const store = useDefaultStore();
const timeline_entry = ref(null);

onMounted(() => {
    let data = new FormData();
    data.append('id', route.params.id);

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

function submitForm() {
    let data = new FormData();
    data.append('title', timeline_entry.value.title);
    data.append('content', timeline_entry.value.content);

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
