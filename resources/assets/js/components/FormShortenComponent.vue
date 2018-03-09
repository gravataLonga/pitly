<template>
    <div>
        <div class="flex justify-center">
            <div class="w-1/2">
                <p class="text-center mb-8 text-grey-darkest text-base font-sans">Cria o teu primeiro URL cortado!</p>
                <input name="url" type="text" class="w-full px-2 py-2 text-2xl text-grey-darker rounded shadow" v-model="url">
            </div>
        </div>
        <div class="flex justify-center mt-4">
            <div class="w-1/4 text-center">
                <button @click="create" type="submit" class="hover:text-pitly-dark hover:bg-white rounded text-white shadow px-2 py-2 bg-pitly-dark text-base font-sans">Corta</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
     data() {
        return {
            url: ''
        }
    },
    methods: {
        create() {
            axios.post('shorter', {
                url: this.url
            }).then(r => {
                // this.shortens.push(r.data.data);
                this.$parent.update(r.data.data);
                this.url = '';
                flash('Your url was shorten!');
            }).catch(error => {
                if (error.response) {
                    // Server reponde with error.
                    if (error.response.status == 422) { flash("Enter a valid url, please")}
                }
            });
        },
    }
}
</script>