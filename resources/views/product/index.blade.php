<?php

/** @var \Illuminate\Database\Eloquent\Collection $products */
?>

<x-app-layout>
    <div class="bg-emerald-100 p-5 rounded-md mb-8">
        <div class="flex flex-wrap items-center justify-center">
            <!-- Image on the left -->
            <img src="{{ asset('Cards.png') }}" alt="Image" class="flex-1 mx-20 mb-2 sm:mx-10 sm:mb-0" style="height: auto;" />
            <div class="flex-1 mx-20 mb-2 sm:mx-10 sm:mb-0">
                <h2 class="text-4xl font-semibold mb-4 text-emerald-800">Welcome to Our PVC Card Printing E-commerce App!</h2>
                <p class="text-lg text-gray-600 leading-6">
                    We are your premier destination for high-quality PVC card printing. Our app offers:
                </p>
                <ul class="list-none ml-6 text-lg text-gray-700 leading-6">
                    <li>🚀 Fast and Reliable Delivery</li>
                    <li>🌟 Best Quality PVC Cards</li>
                    <li>🎨 Wide Range of Customization Options</li>
                    <li>💰 Competitive Prices</li>
                    <li>🌟 Exceptional Customer Service</li>
                </ul>
                <p class="text-lg mt-4 text-gray-600 leading-6">
                    Whether you need PVC cards for your business, events, or any other purpose, we've got you covered.
                </p>
                <a href="mailto:youremail@gmail.com" class="mt-6 inline-block px-4 py-2 text-white bg-emerald-500 hover:bg-emerald-600 rounded-md transition duration-300 ease-in-out">Contact Us</a>
            </div>



        </div>
    </div>






    <?php if ($products->count() === 0) : ?>
        <div class="text-center text-gray-600 py-16 text-xl">
            There are no products published
        </div>
    <?php else : ?>
        <div class="grid gap-8 grig-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-5">
            @foreach($products as $product)
            <!-- Product Item -->
            <div x-data="productItem({{ json_encode([
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'image' => $product->image,
                        'title' => $product->title,
                        'price' => $product->price,
                        'addToCartUrl' => route('cart.add', $product)
                    ]) }})" class="border border-1 border-gray-200 rounded-md hover:border-purple-600 transition-colors bg-white">
                <a href="{{ route('product.view', $product->slug) }}" class="aspect-w-3 aspect-h-2 block overflow-hidden">
                    <img src="{{ $product->image }}" alt="" class="object-cover rounded-lg hover:scale-105 hover:rotate-1 transition-transform" />
                </a>
                <div class="p-4">
                    <h3 class="text-lg">
                        <a href="{{ route('product.view', $product->slug) }}">
                            {{$product->title}}
                        </a>
                    </h3>
                    <h5 class="font-bold">₹{{$product->price}}</h5>
                </div>
                <div class="flex justify-between py-3 px-4">
                    <button class="btn-primary bg-emerald-500 hover:bg-emerald-800" @click="addToCart()">
                        Add to Cart
                    </button>
                </div>
            </div>
            <!--/ Product Item -->
            @endforeach
        </div>
        {{$products->links()}}
    <?php endif; ?>
</x-app-layout>