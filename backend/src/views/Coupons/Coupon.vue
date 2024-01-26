<template>
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Coupons</h1>
    <router-link :to="{ name: 'app.coupons.create' }"
                 class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
    >
      Add new Coupon
    </router-link>
  </div>
  <CouponsTable @clickEdit="editCoupon" />
  <CouponModal v-model="showCouponModal" :coupon="couponModel" @close="onModalClose" />
</template>

<script setup>
import { computed, ref } from "vue";
import store from "../../store";
import CouponModal from "./CouponModal.vue";
import CouponsTable from "./CouponTable.vue";

const DEFAULT_COUPON = {
  id: '',
  code: '',
  discount: 0,
  frequency: '',
  // Add other coupon properties here
};

const coupons = computed(() => store.state.coupons);

const couponModel = ref({ ...DEFAULT_COUPON });
const showCouponModal = ref(false);

function editCoupon(coupon) {
  store.dispatch('getCoupon', coupon.id)
    .then(({ data }) => {
      couponModel.value = data;
    });
}

function onModalClose() {
  couponModel.value = { ...DEFAULT_COUPON };
}
</script>

<style scoped>
/* Add your styles here */
</style>
