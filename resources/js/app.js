import { createApp } from "vue";
import LoginView from "./components/LoginView.vue";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min";


const app = createApp({});
app.component("login-view", LoginView);
app.mount("#app");
