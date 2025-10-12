<template>
    <div class="page-timeline-admin">
        <PageHeader title="Timeline Admin" />

        <WidgetContainer class="mb-4">
            <div class="flex flex-col md:flex-row gap-4">
                <SubHeading>Manage timeline entries.</SubHeading>

                <div v-if="store.logged_in" class="md:grow flex flex-row md:justify-end gap-2">
                    <ButtonText v-on:click="createEntry">Create entry</ButtonText>
                    <ButtonLink url="/media-admin">Media Admin</ButtonLink>
                </div>
            </div>
        </WidgetContainer>

        <div class="text-text bg-widget rounded-md shadow-md mb-10">
            <div class="grid grid-cols-12 gap-3 text-center font-semibold">
                <div class="col-span-2 px-2 py-1">Date</div>
                <div class="col-span-3 px-2 py-1">Title</div>
                <div class="col-span-5 px-2 py-1">Content</div>
                <div class="col-span-2 px-2 py-1">Images</div>
            </div>
            <router-link
                v-for="(entry, idx) in timeline_entries"
                :class="{
                    'grid': true,
                    'grid-cols-12': true,
                    'gap-3': true,
                    'border-t': true,
                    'border-background': true,
                }"
                :to="getEntryLink(entry.id)"
            >
                <div class="col-span-2 px-2 py-1">{{ entry.date + ' ' + entry.time }}</div>
                <div class="col-span-3 px-2 py-1">{{ entry.title ?? 'No title' }}</div>
                <div class="col-span-5 px-2 py-1">{{ entry.content ?? 'No content' }}</div>
                <div class="col-span-2 px-2 py-1">
                    <ul class="flex flex-row gap-3 my-1">
                        <li v-for="(image, idx) in entry.images">
                            <img :src="image.thumbnail" :alt="'Image ' + (idx + 1)">
                        </li>
                    </ul>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonLink from '../components/button-link';
import ButtonText from '../components/button-text';
import PageHeader from '../components/page-header';
import SubHeading from '../components/sub-heading';
import WidgetContainer from '../components/widget-container';
import useDefaultStore from '../stores/default';

const router = useRouter();
const store = useDefaultStore();
const timeline_entries = ref([]);

onMounted(() => {
    let data = new FormData();
    data.append('limit', '0');
    data.append('includeEmpty', '1');

    (new AjaxRequest('POST', '/timeline/entries', data))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response) {
                return;
            }

            timeline_entries.value = response.entries;
        })
        .send();

    store.setBackUrl('/');
});

/**
 * Create a new entry and redirect to the edit form.
 */
function createEntry() {
    (new AjaxRequest('POST', '/timeline-admin/create'))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response) {
                return;
            }

            router.push(getEntryLink(response.id));
        })
        .send();
}

/**
 * Returns the URL for the entry.
 *
 * @param {string} id
 * @returns {string}
 */
function getEntryLink(id) {
    return '/timeline-admin/edit-' + id;
}
</script>
