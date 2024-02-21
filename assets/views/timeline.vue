<template>
    <div class="page-timeline">
        <PageHeader title="Timeline" class="text-center" />

        <p v-if="!timeline_entries.length" class="text-white text-center mb-4">Loading...</p>

        <TimelineEntry
            v-for="entry in this.timeline_entries"
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
            <ButtonBack url="/" />
        </div>
    </div>
</template>

<script>
import { AjaxRequest } from '../lib/ajax-request';
import ButtonBack from '../components/button-back';
import PageHeader from '../components/page-header';
import TimelineEntry from '../components/timeline-entry';

export default {
    components: { ButtonBack, PageHeader, TimelineEntry },
    data() {
        return {
            'timeline_entries': []
        };
    },
    mounted() {
        let data = new FormData();
        data.append('limit', '0');

        let request = new AjaxRequest('POST', '/timeline/entries', data);
        request.send((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response) {
                return;
            }

            this.timeline_entries = response.entries;
        });
    },
};
</script>
