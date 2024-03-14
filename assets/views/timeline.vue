<template>
    <div class="page-timeline">
        <PageHeader title="Timeline" class="text-center" />

        <p v-if="!timeline_entries.length" class="text-white text-center mb-4">Loading...</p>

        <TimelineEntry
            v-for="entry in timeline_entries"
            :key="entry.date + entry.time"
            :id="entry.id"
            :title="entry.title"
            :images="entry.images"
            :date="entry.date"
            :time="entry.time"
        >
            <p v-html="entry.content"></p>
        </TimelineEntry>

        <div class="text-center mb-4">
            <ButtonBack :url="store.back_url" />
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonBack from '../components/button-back';
import PageHeader from '../components/page-header';
import TimelineEntry from '../components/timeline-entry';
import useDefaultStore from '../store';

const store = useDefaultStore();
const timeline_entries = ref([]);

onMounted(() => {
    let data = new FormData();
    data.append('limit', '0');

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
</script>
