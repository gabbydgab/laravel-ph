<template>
    <div>
        <input
            ref="file"
            type="file"
            class="hidden"
            v-bind="$attrs"
            accept="image/*"
            tabindex="-1"
            @change="upload($event.target.files)" />

        <div class="w-full h-64 bg-gray-300 rounded overflow-hidden flex items-center justify-center relative group">
            <template v-if="status == 'idle'">
                <button class="px-3 py-2 h-12 border border-gray-400 text-gray-600 rounded flex items-center focus:outline-none" @click.prevent="toggle">
                    <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M20 7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9c0-1.1.9-2 2-2h2.38l1.73-3.45A1 1 0 0 1 9 3h6a1 1 0 0 1 .9.55L17.61 7H20zM9.62 5L7.89 8.45A1 1 0 0 1 7 9H4v10h16V9h-3a1 1 0 0 1-.9-.55L14.39 5H9.62zM12 17a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                    </svg>
                    <span class="ml-2">Upload Photo</span>
                </button>
            </template>

            <template v-else-if="status == 'loading'">
                <button type="button" class="px-3 py-2 h-12 border text-gray-300 rounded bg-gray-200 opacity-50" disabled>Uploading ...</button>
            </template>

            <template v-else-if="status == 'success'">
                <img class="object-cover w-full h-64 group-hover:opacity-25" :src="localValue" alt="Preview">
                <div class="absolute invisible flex items-center group-hover:visible">
                    <button type="button" class="px-3 py-2 h-12 shadow bg-gray-300 text-gray-700 rounded focus:outline-none" @click.prevent="reset">Reset</button>
                    <button type="button" class="px-3 py-2 h-12 shadow bg-gray-300 text-gray-700 rounded focus:outline-none ml-2" @click.prevent="toggle">Change</button>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    inheritAttrs: false,
    props: {
        value: String
    },
    data () {
        return {
            status: this.value ? 'success' : 'idle',
            localValue: this.value,
        }
    },
    methods: {
        upload (files) {
            let formData = new FormData;
            formData.append('file', files[0]);

            this.status = 'loading';

            axios.post('/media', formData).then(response => {
                this.localValue = response.data.data.url
                this.$refs.file.value = ''
                this.status = 'success'
            });
        },

        toggle () {
            this.$refs.file.click()
        },

        reset () {
            this.localValue = null
            this.status = 'idle'
        }
    },
    watch: {
        localValue: function (value) {
            this.$emit('input', value)
        }
    }
}
</script>

<style>

</style>
