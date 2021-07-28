<template>
    <div
        class="alert alert-success alert-block"
        :class="'alert-'+level"
        role="alert"
        style="padding-right:20px; padding-left:20px"
        v-show="show"
        v-text="body"
    ></div>
</template>

<script>
    export default {
        props: ["message", "levels"],
        data() {
            return {
                body: this.message,
                level: this.levels,
                show: false
            };
        },
        created() {
            if (this.message) {
                this.flash();
            }
        },
        methods: {
            flash() {
                this.show = true;
                this.hide();
            },
            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 4000);
            }
        }
    };
</script>
<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>
