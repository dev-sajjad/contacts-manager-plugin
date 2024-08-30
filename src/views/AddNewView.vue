<script setup>
import { reactive } from "vue";
import { useRouter } from "vue-router";
import { ElMessage } from "element-plus";
import { postAJAX } from "@/composable";
import ContactForm from "@/components/ContactFormComponent.vue";
import "element-plus/es/components/message/style/css";

const router = useRouter();

const oldContact = reactive({
  id: "",
  name: "",
  email: "",
  phone: "",
  address: "",
});

const onSubmit = (contact) => {
  postAJAX("add_contact", contact, ({ success, data }) => {
    if (success) {
      ElMessage({
        message: "Contact added",
        type: "success",
      });
      router.push({ name: "Contacts Table" });
    } else {
      ElMessage({
        message: "Could not add contact - " + data.error,
        type: "error",
      });
    }
  });
};
</script>

<template>
  <div>
    <h2>Add New Contact</h2>
    <ContactForm :contact="oldContact" @form-submit="onSubmit" />
  </div>
</template>

<style scoped></style>
