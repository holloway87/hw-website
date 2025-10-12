<template>
    <div class="page-admin-login">
        <PageHeader title="Admin Login" class="text-center" />

        <div class="sm:max-w-md sm:mx-auto bg-widget rounded-md shadow-md p-4 mb-5">
            <div class="grid grid-cols-6 items-center mb-5">
                <label for="otp-code" class="text-text">Code</label>
                <input
                    type="text"
                    id="otp-code"
                    :class="{
                        'col-span-5': true,
                        'w-full': true,
                        'rounded-md': true,
                        'shadow-md': true,
                        'outline-hidden': true,
                        'py-1.5': true,
                        'px-2': true,
                        'border-2': true,
                        'border-text-shadow': !error_message,
                        'bg-text': !error_message,
                        'text-widget': !error_message,
                        'border-error-shadow': error_message,
                        'bg-error-background': error_message,
                        'text-error': error_message,
                    }"
                    autocomplete="off"
                    autofocus
                    v-model="code"
                    v-on:keyup="checkCodeInput">
                <p v-if="error_message" class="col-span-5 col-start-2 text-error px-2 mt-1">{{ error_message }}</p>
            </div>
            <div class="text-center">
                <ButtonText v-on:click="submitLogin">
                    Login
                </ButtonText>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import { AjaxRequest } from '../lib/ajax-request';
import ButtonText from '../components/button-text';
import PageHeader from '../components/page-header';
import useDefaultStore from '../stores/default';

const code = ref('');
const error_message = ref('');
const router = useRouter();
const store = useDefaultStore();

onMounted(() => store.setBackUrl('/'));

function checkCodeInput(event) {
    if ("Enter" === event.key) {
        submitLogin();
    }

    if (error_message.value) {
        error_message.value = '';
    }
}
function submitLogin() {
    (new AjaxRequest('POST', '/admin-login', {'code': code.value}))
        .done((data) => {
            let response = JSON.parse(data.responseText);
            if (401 === data.status && response.message) {
                error_message.value = response.message;

                return;
            }

            if (!response.success) {
                return;
            }

            store.setLoggedIn(true);
            router.push('/timeline-admin');
        })
        .send();
}
</script>
