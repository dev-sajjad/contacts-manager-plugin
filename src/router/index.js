import { createRouter, createWebHashHistory } from "vue-router";
import TableView from "../views/TableView.vue";
import AddNewView from "../views/AddNewView.vue";
import EditView from "../views/EditView.vue";
import SettingsView from "../views/SettingsView.vue";

const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    {
      path: "/",
      name: "Contacts Table",
      component: TableView,
    },
    {
      path: "/add-new",
      name: "Add New Contact",
      component: AddNewView,
    },
    {
      path: "/edit/:id",
      name: "Edit Contact",
      component: EditView,
      props: true,
    },
    {
      path: "/settings",
      name: "Settings",
      component: SettingsView,
    },
  ],
});

export default router;
