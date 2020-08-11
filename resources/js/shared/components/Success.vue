<template>
    <div class="text-center success">
        <i class="far fa-thumbs-up"></i>
        <h1 class="mt-4">Success!</h1>
        <h2>
            <slot></slot>
        </h2>
    </div>
</template>

<style scoped>
.success {
    color: #999;
    font-size: 10rem;
}
</style>

<!-- 
    --- in myComponent:
    <success v-if="success">It worked!</success>       !!! app.js: Vue.component("success", Success);

    data(){
        return {
            loading: false;
            success: false;
        }        
    }
    methods: {
        submit() {       
            this.loading = true; 
            this.success = false;
            axios
                .post(`/api/a`, this.a)
                .then(response => {
                    this.success = 201 === response.status;        
                })
                .catch(err => {
                    
                }                
                .then(() => (this.loading = false));
        }
  }

-->
