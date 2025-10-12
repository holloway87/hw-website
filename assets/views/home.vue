<template>
    <div class="page-home">
        <PageHeader title="Welcome" />

        <div class="grid sm:grid-cols-2 md:grid-cols-5 lg:grid-cols-3 gap-4">
            <div class="md:col-span-2 lg:col-span-1">
                <WidgetContainer class="mb-10">
                    <SubHeading class="mb-4">Choose a category:</SubHeading>
                    <CardImageLink
                        class="block mb-5"
                        description="Have a look at my illustrations."
                        image="/images/home_art.png"
                        title="Art"
                        url="/illustrations"
                    />
                    <CardImageLink
                        class="block mb-5"
                        description="I sometimes like to take photos."
                        image="/images/home_photos.png"
                        title="Photos"
                        url="/photo-projects"
                    />
                    <CardImageLink
                        class="block"
                        description="These are some of my programming projects."
                        image="/images/home_dev.png"
                        title="Programming"
                        url="/dev"
                    />
                </WidgetContainer>
            </div>
            <div class="md:col-span-3 lg:col-span-2">
                <WidgetContainer class="mb-4">
                    <div class="flex flex-col md:flex-row gap-4">
                        <SubHeading class="md:grow">Latest timeline entry:</SubHeading>
                        <ButtonLink class="order-first md:order-last" url="/timeline">
                            <CalendarIcon class="h-6 inline-block align-bottom" /> Show timeline
                        </ButtonLink>
                    </div>
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
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonLink from '../components/button-link';
import { CalendarIcon } from '@heroicons/vue/24/outline';
import CardImageLink from '../components/card-image-link';
import PageHeader from '../components/page-header';
import SubHeading from '../components/sub-heading';
import TimelineEntry from '../components/timeline-entry';
import WidgetContainer from '../components/widget-container';
import useDefaultStore from '../stores/default';

const store = useDefaultStore();
const timeline_entries = ref([]);

onMounted(() => {
    let data = new FormData();
    data.append('limit', '1');

    (new AjaxRequest('POST', '/timeline/entries', data))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response) {
                return;
            }

            timeline_entries.value = response.entries;
        })
        .send();

    store.setBackUrl('');
});
</script>
