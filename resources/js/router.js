import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomePage from "./pages/HomePage.vue";
import AdvancedSearch from "./pages/AdvancedSearch.vue";
import SingleApartment from "./pages/SingleApartment.vue";
import ContactForm from "./pages/ContactForm.vue";
import SimpleSearch from './pages/SimpleSearch.vue';
import Page404 from './pages/Page404.vue';

const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/",
      name: 'homepage',
      component: HomePage
    },
    {
      path: "/search",
      name: 'apartments',
      component: SimpleSearch
    },
    {
      path: "/advanced_search",
      name: 'advanced-search',
      component: AdvancedSearch
    },
    {
      path: "/apartment/:slug",
      name: "single-apartment",
      component: SingleApartment
    },
    {
      path: "/apartment/:slug/contact",
      name: "contact-form",
      component: ContactForm
    },
    {
      path: "/*", //link non riconosciuto
      component: Page404,
    },
  ]
});

export default router;