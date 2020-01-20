<template>
    <span>{{ representation }}</span>
</template>

<script>
export default {
    props: {
        value: String,
        format: String,
    },
    computed: {
        representation () {
            if (! this.value) {
                return null
            }

            if (! this.format || this.format == 'fromNow') {
                return dayjs(this.value).fromNow()
            }

            return dayjs(this.value).format(this.format)
        }
    }
}
</script>

<style>

</style>
