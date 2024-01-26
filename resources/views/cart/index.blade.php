<x-app-layout>
    <div class="container lg:w-2/3 xl:w-2/3 mx-auto">
        <h1 class="text-3xl font-bold mb-6">Your Cart Items</h1>

        <div x-data="{
            cartItems: {{
                json_encode(
                    $products->map(fn($product) => [
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'image' => $product->image,
                        'title' => $product->title,
                        'price' => $product->price,
                        'quantity' => $cartItems[$product->id]['quantity'],
                        'href' => route('product.view', $product->slug),
                        'removeUrl' => route('cart.remove', $product),
                        'updateQuantityUrl' => route('cart.update-quantity', $product)
                    ])
                )
            }},
            pdfUploaded: false, // Track PDF upload status
            checkoutDisabled: true, // Initially disabled
            pdfUrl: '', // URL of the uploaded PDF
            coupon_discount:0,
            discount_amount:0,
            enableCheckout: function () {
                // Check the file size
                var pdfFileInput = document.getElementById('pdfFile');
                if (pdfFileInput.files.length > 0) {
                    var fileSizeInMB = pdfFileInput.files[0].size / (1024 * 1024);
                    if (fileSizeInMB > 100) {
                        alert('Warning: The uploaded PDF file exceeds 2MB in size.');
                        // Disable the checkout button if the file size exceeds 2MB
                        this.checkoutDisabled = true;
                        // Clear the input value
                        pdfFileInput.value = '';
                    } else {
                        // Enable the checkout button if the file size is within limits
                        this.pdfUploaded = true;
                        this.checkoutDisabled = false;
                        // Set the PDF URL for viewing
                        this.pdfUrl = URL.createObjectURL(pdfFileInput.files[0]);
                    }
                }
            },
            disableCheckout: function () {
                if (!this.pdfUploaded) {
                    alert('Please upload a PDF file before proceeding to checkout.');
                }
            },
            get cartTotal() {
                return this.cartItems.reduce((accum, next) => accum + next.price * next.quantity, 0).toFixed(2)
            },
            viewPdf: function () {
                if (this.pdfUrl) {
                    window.open(this.pdfUrl, '_blank'); // Open the PDF in a new tab
                }
            }
        }" class="bg-white p-4 rounded-lg shadow">
            <!-- Product Items -->
            <template x-if="cartItems.length">
                <div>
                    <!-- Product Item -->
                    <template x-for="product of cartItems" :key="product.id">
                        <div x-data="productItem(product)">
                            <div class="w-full flex flex-col sm:flex-row items-center gap-4 flex-1">
                                <a :href="product.href" class="w-36 h-32 flex items-center justify-center overflow-hidden">
                                    <img :src="product.image" class="object-cover" alt="" />
                                </a>
                                <div class="flex flex-col justify-between flex-1">
                                    <div class="flex justify-between mb-3">
                                        <h3 x-text="product.title"></h3>
                                        <span class="text-lg font-semibold">
                                            ₹<span x-text="product.price"></span>
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            Qty:
                                            <input type="number" min="1" x-model="product.quantity" @change="changeQuantity()" class="ml-3 py-1 border-gray-200 focus:border-purple-600 focus:ring-purple-600 w-16" />
                                        </div>
                                        <a href="#" @click.prevent="removeItemFromCart()" class="text-purple-600 hover:text-purple-500">Remove</a>
                                    </div>
                                </div>
                            </div>
                            <!--/ Product Item -->
                            <hr class="my-5" />
                        </div>
                    </template>
                    <!-- Product Item -->
                    <!-- Coupon Code Input -->
                    <div class="mt-4">
                        <label for="couponCode" class="block text-gray-700 text-sm font-bold mb-2">Coupon Code:</label>
                        <input type="text" name="couponCode" id="couponCode" class="w-full" placeholder="Enter your coupon code">
                    </div>


                    <!-- Apply Coupon Button -->
                    <button @click="applyCoupon()" class="mt-2 btn-secondary bg-blue-500 hover:bg-blue-700 text-white w-full py-3 text-lg">
                        Apply Coupon
                    </button>

                    <!-- Total Discount -->
                    <div class="mt-4">
                        <span class="font-semibold">Total Discount:</span>
                        <span id="discountAmount" class="text-xl">No coupon Applied</span>
                    </div>

                    <!-- Total Amount after discount -->

                    <div class="mt-4">
                        <span class="font-semibold">Total Amount after discount:</span>
                        <span id="totalAmountAfterDiscount" class="text-xl">No coupon Applied</span>
                    </div>
                    <div class="border-t border-gray-300 pt-4">
                        <div class="flex justify-between">
                            <span class="font-semibold">Subtotal</span>
                            <span id="cartTotal" class="text-xl" x-text="`₹${cartTotal}`"></span>
                        </div>
                        <div class="mt-4">
                            <span class="font-semibold">Subtotal (after applied coupon):</span>
                            <span id="subtotalAfterCoupon" class="text-xl">No coupon Applied</span>
                        </div>
                        <!-- Shipping Options -->
                        <div class="mt-4 shipping-options">
                            <div class="shipping-option">
                                <input type="radio" name="shipping_method" value="ODTDC" data-price="100.00" @click="calculateTotal()" id="odtdcOption" checked>
                                <label for="odtdcOption">ODTDC (PINCODE SHOULD BE SERVICEABLE): ₹100.00</label>
                            </div>
                            <div class="shipping-option">
                                <input type="radio" name="shipping_method" value="OEMSSPEEDPOST" data-price="60.00" @click="calculateTotal()" id="speedPostOption">
                                <label for="speedPostOption">OEMS SPEED POST ₹60.00</label>
                            </div>
                            <div class="shipping-option">
                                <input type="radio" name="shipping_method" value="REGISTERPOST" data-price="40.00" @click="calculateTotal()" id="registerPostOption">
                                <label for="registerPostOption">Register Post Shipping (Tracking Available Delivery Transit Time 8-10 Days) We are not responsible for any delayed delivery by post: ₹40.00</label>
                            </div>
                            <div class="shipping-option">
                                <input type="radio" name="shipping_method" value="BLUEDART" data-price="200.00" @click="calculateTotal()" id="blueDartOption">
                                <label for="blueDartOption">BlueDart (Select only if it's available in your area): ₹200.00</label>
                            </div>
                        </div>
                        <!-- /Shipping Options -->
                    </div>
                    <form action="{{ route('cart.checkout') }}" method="post" id="checkoutForm" enctype="multipart/form-data" onsubmit="return validateForm()">
                        @csrf
                        <div class="mb-4">
                            <label for="pdfFile" class="block text-gray-700 text-sm font-bold mb-2">Select PDF File ( max size : 100 mb ):</label>
                            <input type="file" name="pdfFile" id="pdfFile" accept=".pdf" class="w-full" @change="enableCheckout()">
                        </div>
                        <input type="hidden" name="shippingMethod" id="shippingMethod">
                        <!-- Default value, change dynamically -->
                        <input type="hidden" name="coupon_name" id="coupon_name">
                        <input type="hidden" name="discountValue" id="discountValue">
                        <!-- View Uploaded PDF Button -->
                        <template x-if="pdfUrl">
                            <button @click="viewPdf" class="mt-2 btn-secondary bg-blue-500 hover:bg-blue-700 text-white w-full py-3 text-lg">
                                View Uploaded PDF
                            </button>
                        </template>
                        <template x-if="checkoutDisabled">
                            <button class="btn-primary bg-emerald-500 hover:bg-emerald-800 w-full py-3 text-lg" :disabled=true>
                                Upload Pdf to Continue
                            </button>
                        </template>
                        <template x-if="!checkoutDisabled">
                            <button type="submit" class="btn-primary bg-emerald-500 hover:bg-emerald-800 w-full py-3 text-lg" :disabled="checkoutDisabled">Proceed to Checkout</button>
                        </template>
                    </form>

                </div>
        </div>
    </div>
    <!--/ Product Items -->
    </template>
    <template x-if="!cartItems.length">
        <div class="text-center py-8 text-gray-500">
            You don't have any items in the cart
        </div>
    </template>
    </div>
</x-app-layout>

<script>
    function validateForm() {
        // Check the file size again
        var pdfFileInput = document.getElementById('pdfFile');
        if (pdfFileInput.files.length > 0) {
            var fileSizeInMB = pdfFileInput.files[0].size / (1024 * 1024);
            if (fileSizeInMB > 100) {
                alert('Warning: The uploaded PDF file exceeds 2MB in size.');
                // Clear the input value
                pdfFileInput.value = '';
                return false; // Prevent form submission
            }
        }
        return true; // Allow form submission
    }

    function calculateTotal() {
        var selectedShippingMethod = document.querySelector('input[name="shipping_method"]:checked');
        var shippingPrice = selectedShippingMethod ? parseFloat(selectedShippingMethod.getAttribute('data-price')) : 100.00;
        var cartTotal; // Initialize cartTotal variable

        if (document.getElementById('subtotalAfterCoupon')) {
            // Use subtotalAfterCoupon if it exists (coupon applied)
            cartTotal = parseFloat(document.getElementById('subtotalAfterCoupon').innerText.replace('₹', ''));
        } else {
            // Use cartTotal if no coupon applied
            cartTotal = parseFloat(document.getElementById('cartTotal').innerText.replace('₹', ''));
        }
        var totalAmount = cartTotal + shippingPrice;
        document.getElementById('totalAmount').innerText = '₹' + totalAmount.toFixed(2);
        document.getElementById('shippingMethod').value = selectedShippingMethod.getAttribute('value')
        console.log(document.getElementById('shippingMethod').value)

    }

    function applyCoupon() {
        var cartTotal = parseFloat(document.getElementById('cartTotal').innerText.replace('₹', ''));
        var couponCode = document.getElementById('couponCode').value;

        if (couponCode !== '') {
            // Send an AJAX request to validate the coupon code on the server
            axios.post('/validate-coupon', {
                    couponCode: couponCode
                })
                .then((response) => {
                    const data = response.data;
                    if (data.valid) {
                        const discountAmount = parseFloat(data.discount);
                        document.getElementById('discountValue').value = parseFloat(discountAmount);
                        document.getElementById('coupon_name').value = couponCode;

                        // Calculate the discount based on discountAmount
                        var selectedShippingMethod = document.querySelector('input[name="shipping_method"]:checked');
                        var shippingPrice = selectedShippingMethod ? parseFloat(selectedShippingMethod.getAttribute('data-price')) : 100.00;
                        var cartTotalWithShipping = cartTotal;

                        var discount = (cartTotalWithShipping * (parseFloat(discountAmount) / 100)).toFixed(2);
                        var totalAmountAfterDiscount = (cartTotalWithShipping - parseFloat(discount)).toFixed(2);
                        shippingMethod = selectedShippingMethod.getAttribute('value');

                        // Update the discount amount and total amount after discount
                        document.getElementById('discountAmount').innerText = '₹' + discount;
                        document.getElementById('totalAmountAfterDiscount').innerText = '₹' + totalAmountAfterDiscount;

                        // Update the subtotal (before coupon)
                        //document.getElementById('subtotalBeforeCoupon').innerText = '₹' + cartTotal.toFixed(2);

                        // Update the subtotal (after applied coupon)
                        document.getElementById('subtotalAfterCoupon').innerText = '₹' + totalAmountAfterDiscount;
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