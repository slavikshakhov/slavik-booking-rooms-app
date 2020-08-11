<template>
    <div class="text-center error">
        <i class="fas fa-bomb"></i>
        <h1 class="mt-4">We've encountered a problem</h1>
        <h2>Unfortunately we cannot proceed</h2>
    </div>
</template>

<style scoped>
.error {
    color: #999;
    font-size: 10rem;
}
</style>

<!-- 
    --- in myComponent:

    <fatal-error v-if="error"></fatal-error>       !!! app.js: Vue.component("fatal-error", FatalError);

    data(){
        return {
            loading: false;
            error: false;
        }        
    }
    methods: {
        submit() {       
            this.loading = true; 
            this.success = false;
            axios
                .post(`/api/a`, this.a)
                .then(response => {

                })
                .catch(err => {
                    this.error = !is404(err);              !!! js/shared/utils/responseStatus.js 
                }                
                .then(() => (this.loading = false));
        }
    }

-->
