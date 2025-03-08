<template>
    <div class="page-home">
        <PageHeader title="Welcome">
            Choose a category:
        </PageHeader>

        <CardsContainer class="mb-10">
            <CardImageLink
                class="mb-5"
                description="Have a look at my illustrations."
                image="/images/home_art.png"
                title="Art"
                url="/illustrations"
            />
            <CardImageLink
                class="mb-5"
                description="I sometimes like to take photos."
                image="/images/home_photos.png"
                title="Photos"
                url="/photo-projects"
            />
            <CardImageLink
                class="mb-5"
                description="These are some of my programming projects."
                image="/images/home_dev.png"
                title="Programming"
                url="/dev"
            />
        </CardsContainer>

        <div class="flex flex-col sm:flex-row sm:justify-center gap-4 w-full mb-4">
            <div class="sm:text-right">
                <ButtonLink url="/timeline">
                    <CalendarIcon class="h-6 inline-block align-bottom" /> Show timeline
                </ButtonLink>
            </div>
            <p class="text-white my-auto">Recent posts:</p>
        </div>

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
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonLink from '../components/button-link';
import { CalendarIcon } from '@heroicons/vue/24/outline';
import CardImageLink from '../components/card-image-link';
import CardsContainer from '../components/cards-container';
import PageHeader from '../components/page-header';
import TimelineEntry from '../components/timeline-entry';
import useDefaultStore from '../stores/default';

const store = useDefaultStore();
const timeline_entries = ref([]);

onMounted(() => {
    let data = new FormData();
    data.append('limit', '5');

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
