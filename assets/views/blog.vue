<template>
    <div class="blog-page">
        <PageHeader title="Blog" class="text-center" />
        <div class="sm:max-w-2xl sm:mx-auto mb-10">
            <BlogEntry
                v-for="entry in blog_entries"
                :content="entry.content"
                :date="entry.date"
                :link="entry.link"
                :time="entry.time"
                :title="entry.title"
            />

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
import BlogEntry from '../components/blog-entry';
import ButtonBack from '../components/button-back';
import PageHeader from '../components/page-header';
import WidgetContainer from '../components/widget-container';
import useDefaultStore from '../stores/default';

const store = useDefaultStore();
const blog_entries = ref([]);

onMounted(() => {
    let data = new FormData();
    data.append('limit', '0');

    (new AjaxRequest('POST', '/blog/get-entries', data))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response || !response.success) {
                return;
            }

            blog_entries.value = response.entries;
        })
        .send();
    store.setBackUrl('/');
});
</script>
