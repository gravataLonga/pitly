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
        <div class="flex mt-8 flex-wrap">
            <div class="w-1/4" v-for="item in shortens">
                <div class="m-2 rounded shadow bg-white cursor-pointer  border-2 border-pitly-dark px-2 py-4">
                    <h4 class="mb-2">
                        <a class="text-pitly-dark font-sans" v-bind:href="item.original">
                            {{item.shorted}}
                        </a>
                        <br />
                        <span class="text-xs mt-2 text-serif">{{ item.original }}</span>
                    </h4>
                    <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-xs font-semibold text-grey-darker mr-2">{{ item.token }}</span>
                    <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-xs font-semibold text-grey-darker mr-2 content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3" viewBox="0 0 20 20"><path d="M.2 10a11 11 0 0 1 19.6 0A11 11 0 0 1 .2 10zm9.8 4a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-2a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg> {{ item.hit }}
                    </span>
                </div>
            </div>
        </div>
        <div class="flex justify-between mt-8 mb-8">
            <div v-on:click="prevPage" v-show="prev" class="border rounded shadow px-4 py-2 bg-white" :href="prev">
                Prev
            </div>
            <div v-on:click="nextPage" v-show="next" class="border rounded shadow px-4 py-2 bg-white" :href="next">
                Next
            </div>
        </div>
    </div>  
</template>

<script>
    export default {
        data() {
            return {
                url: '',
                shortens: [],
                next: false,
                prev: false
            }
        },
        created() {
            this.fetch();
        },
        methods: {
            create() {
                axios.post('shorter', {
                    url: this.url
                }).then(r => {
                    this.shortens.push(r.data.data);
                    this.url = ''
                    flash('Your url was shorten!');
                }).catch(error => {
                    if (error.response) {
                        // Server reponde with error.
                        if (error.response.status == 422) { flash("Enter a valid url, please")}
                    }
                });
            },
            fetch(url = null) {
                axios.get(url ? url : 'api/shorten').then(r => {
                    this.shortens = r.data.data;
                    this.next = r.data.meta.pagination.links.next;
                    this.prev = r.data.meta.pagination.links.previous;
                });
            },
            nextPage() {
                this.fetch(this.next);
            },
            prevPage() {
                this.fetch(this.prev);
            }
        }
    }
</script>
