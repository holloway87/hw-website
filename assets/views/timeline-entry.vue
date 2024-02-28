<template>
    <div class="page-timeline-entry">
        <PageHeader title="Timeline entry" class="text-center" />

        <p v-if="!timeline_entry" class="text-white text-center mb-4">Loading...</p>
        <TimelineEntry
            v-if="timeline_entry"
            :id="timeline_entry.id"
            :title="timeline_entry.title"
            :images="timeline_entry.images"
            :date="timeline_entry.date"
            :time="timeline_entry.time"
        >
            <p v-html="timeline_entry.content"></p>
        </TimelineEntry>

        <div class="text-center mb-4">
            <ButtonBack :url="store.back_url" />
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonBack from '../components/button-back';
import PageHeader from '../components/page-header';
import TimelineEntry from '../components/timeline-entry';
import useDefaultStore from '../store';

const route = useRoute();
const store = useDefaultStore();
const timeline_entry = ref(null);

onMounted(() => {
    let data = new FormData();
    data.append('id', route.params.id);

    let request = new AjaxRequest('POST', '/timeline/entries', data);
    request.send((data) => {
        let response = JSON.parse(data.responseText);
        if ('object' !== typeof response || !response.success) {
            return;
        }

        if (1 === response.entries.length) {
            timeline_entry.value = response.entries[0];
        }
    });

    store.setBackUrl('/timeline');
});
</script>
