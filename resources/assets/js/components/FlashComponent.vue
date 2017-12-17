<template>
    <div 
        class="text-center py-4 lg:px-4 fixed pin-r pin-b"
        :class="'bg-indigo-'+level" 
        v-show="show"
        >
      <div class="p-2 bg-indigo-darker items-center text-indigo-lightest leading-none lg:rounded-full flex lg:inline-flex" role="alert">
        <span class="flex rounded-full bg-indigo uppercase px-2 py-1 text-xs font-bold mr-3" v-text="level"></span>
        <span class="font-semibold mr-2 text-left flex-auto" v-text="body"></span>
        <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
      </div>
    </div>
</template>

<script>
    export default {
        props: ['message'],
        data () {
            return {
                body: this.message,
                level: 'success',
                show: false
            }
        },

        created() {
            this.flash(this.message)

            window.events.$on('flash', data => this.flash(data));
        },

        methods: {
            flash(data) {
                if (data.message == '') return;
                this.show = true;
                this.body = data.message;
                this.level = data.level;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    }
</script>