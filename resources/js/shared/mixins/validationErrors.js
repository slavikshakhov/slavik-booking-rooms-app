export default {
    data() {
        return {
            errors: null
        };
    },
    methods: {
        errorFor(field) {
            return null !== this.errors && this.errors[field]
                ? this.errors[field]
                : null;
        }
    }
};
/*
    ------js/components/myComp.js -----
    
    (template, input) :class="[{'is-invalid': errorFor('content')}]"
    (template, under input) <v-errors :errors="errorFor('content')"></v-errors>
    mixins: [validationErrors],
    methods: {
        submit() {        
            this.errors = null;
            this.loading = true;
            this.success = false;
            axios
                .post(`/api/a`, this.a)
                .then(response => {
                    this.success = 201 === response.status;     // in data()
                })
                .catch(err => {
                    if (is422(error)) {
                        this.errors = error.response.data.errors;
                    }                    
                    this.error = true;
                })
                .then(() => (this.loading = false));
        }
    }
    !!! v-errors globally registered in app.js: Vue.component("v-errors", ValidationErrors);
                 js/shared/components/ValidationErrors.js
        is422  --- js/shared/utils/responseStatus.js
    
*/
