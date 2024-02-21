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
                    <b-icon-calendar class="inline-block align-text-top text-xl mr-1" /> Show timeline
                </ButtonLink>
            </div>
            <p class="text-white my-auto">Recent posts:</p>
        </div>

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
    </div>
</template>

<script>
import { AjaxRequest } from '../lib/ajax-request';
import { BIconCalendar } from 'bootstrap-vue';
import ButtonLink from '../components/button-link';
import CardImageLink from '../components/card-image-link';
import CardsContainer from '../components/cards-container';
import PageHeader from '../components/page-header';
import TimelineEntry from '../components/timeline-entry';

export default {
    components: { BIconCalendar, ButtonLink, CardImageLink ,CardsContainer, PageHeader, TimelineEntry },
    data() {
        return {
            'timeline_entries': []
        };
    },
    mounted() {
        let data = new FormData();
        data.append('limit', '5');

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
