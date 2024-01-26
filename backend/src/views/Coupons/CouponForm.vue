<template>
  <div class="flex items-center justify-between mb-3">
    <h1 v-if="!loading" class="text-3xl font-semibold">
      {{ coupon.id ? `Update coupon: "${coupon.discount_code}"` : 'Create new Coupon' }}
    </h1>
  </div>
  <div class="bg-white rounded-lg shadow animate-fade-in-down">
    <Spinner v-if="loading"
             class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center z-50"/>
    <form v-if="!loading" @submit.prevent="onSubmit">
      <div class="grid grid-cols-2">
        <div class="col-span-2 px-4 pt-5 pb-4">
          <CustomInput class="mb-2" v-model="coupon.discount_code" label="Coupon Code"/>
          <CustomInput type="number" class="mb-2" v-model="coupon.discount" label="Discount" prepend="%"/>
          <CustomInput type="number" class="mb-2" v-model="coupon.frequency" label="Total Quantity"/>

        </div>
      </div>
      <footer class="bg-gray-50 rounded-b-lg px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="submit"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm
                          text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
          Save
        </button>
        <button type="button"
                @click="onSubmit($event, true)"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm
                          text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
          Save & Close
        </button>
        <router-link :to="{name: 'app.coupons'}"
                     class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                     ref="cancelButtonRef">
          Cancel
        </router-link>
      </footer>
    </form>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import CustomInput from "../../components/core/CustomInput.vue";
import store from "../../store/index.js";
import Spinner from "../../components/core/Spinner.vue";
import { useRoute, useRouter } from "vue-router";


const route = useRoute();
const router = useRouter();

const coupon = ref({
  id: null,
  discount_code: null,
  discount: null,
  frequency: null,
});

const loading = ref(false);

const emit = defineEmits(['update:modelValue', 'close']);

onMounted(() => {
  if (route.params.id) {
    loading.value = true;
    store.dispatch('getCoupon', route.params.id)
      .then((response) => {
        loading.value = false;
        coupon.value = response.data;
      });
  }
});

function onSubmit($event, close = false) {
  loading.value = true;
  if (coupon.value.id) {
    store.dispatch('updateCoupon', coupon.value)
      .then(response => {
        loading.value = false;
        if (response.status === 200) {
          coupon.value = response.data;
          store.commit('showToast', 'Coupon was successfully updated');
          store.dispatch('getCoupons');
          if (close) {
            router.push({ name: 'app.coupons.create' });
          }
        }
      });
  } else {
    store.dispatch('createCoupon', coupon.value)
      .then(response => {
        loading.value = false;
        if (response.status === 201) {
          coupon.value = response.data;
          store.commit('showToast', 'Coupon was successfully created');
          store.dispatch('getCoupons');
          if (close) {
            router.push({ name: 'app.coupons.create' });
          } else {
            coupon.value = response.data;
            router.push({ name: 'app.coupons.edit', params: { id: response.data.id } });
          }
        }
      })
      .catch(err => {
        loading.value = false;
        // debugger;
      });
  }
}
</script>
