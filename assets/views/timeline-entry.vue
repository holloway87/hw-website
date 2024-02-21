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
            <ButtonBack url="/timeline" />
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
            'timeline_entry': null
        };
    },
    mounted() {
        let data = new FormData();
        data.append('id', this.$route.params.id);

        let request = new AjaxRequest('POST', '/timeline/entries', data);
        request.send((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response || !response.success) {
                return;
            }

            if (1 === response.entries.length) {
                this.timeline_entry = response.entries[0];
            }
        });
    },
};
</script>
