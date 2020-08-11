import VueRouter from "vue-router";

// import A from "./components/A";

const routes = [
    /*
    {
        path: "/",
        component: A,
        name: "a"
    }  
    */
];

const router = new VueRouter({
    routes,
    mode: "history"
});

export default router;
