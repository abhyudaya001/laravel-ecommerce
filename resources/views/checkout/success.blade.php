<x-app-layout>
    <div class="w-[400px] mx-auto bg-emerald-500 py-2 px-3 text-white rounded">
        {{$customer->name}}, Your order has been completed!!
    </div>
</x-app-layout>

<script>
   function applyCoupon(couponCode) {
        if (couponCode !== '') {
            // Send an AJAX request to validate the coupon code on the server
            axios.post('/validate-coupon', {
                couponCode: this.couponCode
            })
            .then((response) => {
                const data = response.data;
                if (data.valid) {
                    // Update the coupon frequency (reduce it by 1)
                    axios.post('/update-coupon-frequency', {
                        couponCode: this.couponCode
                    })
                    .then(() => {
                        // Frequency updated
                    })
                    .catch((error) => {
                        console.error(error);
                    });
                } else {
                    alert('Invalid coupon code.');
                }
            })
            .catch((error) => {
                console.error(error);
            });
        } else {
            alert('Please enter a coupon code.');
        }
    }
</script>