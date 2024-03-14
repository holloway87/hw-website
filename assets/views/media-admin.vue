<template>
    <div id="page-media-admin">
        <PageHeader title="Media Admin">Manage media files</PageHeader>

        <div class="text-white mb-5">
            <div v-if="'object' === typeof list.directories" class="sm:flex sm:flex-row sm:gap-2">
                <div class="mb-4">
                    <div class="bg-[#151f1d] rounded-t-md text-center font-semibold">
                        <div class="px-2 py-1">Directories</div>
                    </div>
                    <router-link
                        v-for="(entry, idx) in list.directories"
                        :class="{
                            'block': true,
                            'bg-[#151f1d]': true,
                            'border-t': true,
                            'border-[#1f2e2b]': true,
                            'rounded-b-md': idx === list.directories.length - 1
                        }"
                        :to="getDirectoryLink(entry)"
                    >
                        <div class="px-2 py-1">{{ entry }}</div>
                    </router-link>
                </div>
                <div class="grow mb-4">
                    <div class="bg-[#151f1d] rounded-t-md text-center font-semibold">
                        <div class="px-2 py-1">Images</div>
                    </div>
                    <ul
                        v-if="list.files.length"
                        class="grid grid-cols-7 gap-2 bg-[#151f1d] border-t border-[#1f2e2b] rounded-b-md p-2"
                    >
                        <li v-for="entry in list.files">
                            <img :src="getImageLink(entry)" :alt="entry" :title="entry">
                        </li>
                    </ul>
                    <div
                        v-if="!list.files.length"
                        class="bg-[#151f1d] border-t border-[#1f2e2b] rounded-b-md px-2 py-1"
                    >
                        <p>No images</p>
                    </div>
                </div>
            </div>
            <div v-if="'undefined' === typeof list.directories">
                <p>Loading...</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { onBeforeRouteUpdate, useRoute } from 'vue-router';
import { AjaxRequest } from '../lib/ajax-request';
import PageHeader from '../components/page-header';
import useDefaultStore from '../store';

const list = ref({});
const route = useRoute();
const store = useDefaultStore();

onBeforeRouteUpdate((to, from) => {
    if (from.params.path === to.params.path) {
        return;
    }

    loadList(to.params.path);
});

onMounted(() => {
    loadList(route.params.path);

    store.setBackUrl('/timeline-admin');
});

function getDirectoryLink(name) {
    if ('..' === name) {
        return '/media-admin' + route.params.path.replace(/\/[^\/]+$/, '')
    }

    return '/media-admin' + route.params.path + name;
}

function getImageLink(file) {
    return route.params.path + '/' + file;
}

function loadList(path) {
    let data = new FormData();
    data.append('path', path);

    list.value = {};
    let request = new AjaxRequest('POST', '/media-list', data);
    request.send((data) => {
        let response = JSON.parse(data.responseText);
        if ('object' !== typeof response) {
            return;
        }

        list.value = response.list;
    });
}
</script>
