<template>
<div class="blog-page">
    <PageHeader title="Blog" class="text-center" />
    <div class="sm:max-w-2xl sm:mx-auto mb-10">
        <BlogEntry
            v-if="blog_entry"
            :content="blog_entry.content"
            :date="blog_entry.date"
            :link="blog_entry.link"
            :time="blog_entry.time"
            :title="blog_entry.title"
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
import { useRoute } from 'vue-router';
import { AjaxRequest } from '../lib/ajax-request';
import BlogEntry from '../components/blog-entry';
import ButtonBack from '../components/button-back';
import PageHeader from '../components/page-header';
import WidgetContainer from '../components/widget-container';
import useDefaultStore from '../stores/default';

const route = useRoute();
const store = useDefaultStore();
const blog_entry = ref(null);

onMounted(() => {
    let data = new FormData();
    data.append('limit', 0);
    data.append('slug', route.params.slug);

    (new AjaxRequest('POST', '/blog/get-entries', data))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if ('object' !== typeof response || !response.success) {
                return;
            }

            if (1 === response.entries.length) {
                blog_entry.value = response.entries[0];
            }
        })
        .send();
    store.setBackUrl('/blog');
});
</script>
