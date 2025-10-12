<template>
    <div class="page-timeline">
        <PageHeader title="Timeline" class="text-center" />

        <p v-if="!timeline_entries.length" class="text-text text-center mb-4">Loading...</p>

        <div class="sm:max-w-2xl sm:mx-auto mb-10">
            <WidgetContainer v-if="store.logged_in" class="mb-4 md:text-right">
                <ButtonLink url="/timeline-admin">Timeline Admin</ButtonLink>
            </WidgetContainer>

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

            <WidgetContainer>
                <div class="text-center">
                    <ButtonBack :url="store.back_url" />
                </div>
            </WidgetContainer>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonBack from '../components/button-back';
import ButtonLink from '../components/button-link';
import PageHeader from '../components/page-header';
import TimelineEntry from '../components/timeline-entry';
import WidgetContainer from '../components/widget-container';
import useDefaultStore from '../stores/default';

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
