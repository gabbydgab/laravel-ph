<template>
    <div>
        <div class="flex -mx-4">
            <div class="w-48 px-4">
                <div class="relative">
                    <v-date-picker
                        :value="localValueAsDate"
                        @input="patchDate($event)"
                        :popover="{ visibility: 'click' }">
                        <input
                            type="text"
                            v-on="inputEvents"
                            v-bind="inputProps"
                            slot-scope="{ inputProps, inputEvents }"
                            class="block w-full px-3 py-2 pr-10 h-12 bg-white rounded shadow focus:outline-none"
                            readonly>
                    </v-date-picker>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                        <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M17 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h2V3a1 1 0 1 1 2 0v1h6V3a1 1 0 0 1 2 0v1zm-2 2H9v1a1 1 0 1 1-2 0V6H5v4h14V6h-2v1a1 1 0 0 1-2 0V6zm4 6H5v8h14v-8z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="w-32">
                <div class="relative">
                    <select
                        :value="localValueAsTime"
                        @input="patchTime($event.target.value)"
                        class="block w-full px-3 py-2 pr-10 h-12 bg-white rounded shadow appearance-none leading-tight focus:outline-none">
                        <option v-for="time in timeInterval" :key="time" :value="time">{{ time }}</option>
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                        <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import _ from "lodash"
import dayjs from "dayjs"

export default {
    inheritAttrs: false,
    props: {
        value: String,
        format: {
            type: String,
            default: 'YYYY-MM-DD HH:mm:ss'
        }
    },
    data () {
        return {
            localValue: this.value,
            timeInterval: _.times(24).map(hour => ('0' + hour).slice(-2) + ':00')
        }
    },
    computed: {
        localValueAsDate () {
            if (! this.localValue) {
                return  null
            }

            return new Date(this.localValue)
        },

        localValueAsTime () {
            if (! this.localValue) {
                return null
            }

            return dayjs(this.localValue).format('HH:mm')
        }
    },
    methods: {
        patchDate (value) {
            let newDate = dayjs(value)

            if (! newDate.isValid()) {
                this.localValue = null

                return
            }

            let localDate = dayjs(this.localValue)

            if (! localDate.isValid()) {
                this.localValue = newDate.format(this.format)

                return
            }

            this.localValue = (
                localDate.set('date', newDate.get('date'))
                    .set('month', newDate.get('month'))
                    .set('year', newDate.get('year'))
                    .format(this.format)
            )
        },

        patchTime (value) {
            this.localValue = this.localValue.replace(/(\d\d):(\d\d)/, value)
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
.vc-container {
    font-family: inherit !important;
}
</style>
