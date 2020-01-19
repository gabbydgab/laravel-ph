<template>
    <div class="flex flex-wrap pl-3 pt-2 rounded shadow bg-white">
        <div
            class="inline-flex items-center px-2 py-1 mb-2 mr-2 bg-gray-200 rounded "
            v-for="(tag, i) in tags"
            :key="i">
            <span class="text-gray-600 font-medium text-sm">{{ tag }}</span>

            <button type="button" v-on:click.prevent="removeAt(i)" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 ml-2 fill-current text-gray-500">
                    <path d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"/>
                </svg>
            </button>

            <input type="hidden" v-bind:name="name" v-bind:value="tag" />
        </div>

        <input
            style="min-width: 5rem;"
            class="flex-1 h-12 -mt-2 focus:outline-none"
            v-on:keydown.enter.prevent="push($event.target.value)"
            v-on:keydown.tab.prevent="push($event.target.value)"
            v-on:keydown.delete="pop()"
            placeholder="Enter tags"
            ref="tokenInput">
    </div>
</template>

<script>
export default {
    props: {
        value: Array,
        name: String
    },
    data () {
        return {
            tags: this.value || []
        }
    },
    methods: {
        push (tag) {
            if (! tag.trim()) {
                return
            }

            if (this.tags.indexOf(tag.trim()) === -1) {
                this.tags.push(tag)
            }

            this.$refs.tokenInput.value = ''
        },

        pop () {
            if (this.$refs.tokenInput.value) {
                return
            }

            this.tags.pop()
        },

        removeAt (index) {
            this.tags.splice(index, 1)
        }
    }
}
</script>

<style>

</style>
