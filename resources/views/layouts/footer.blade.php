<footer x-data="{ mobileMenuOpen: false }" class="bg-slate-800 text-white mt-auto">
    <div class="container mx-auto py-6 flex justify-between items-center">
        <div>
            <p class="text-lg font-semibold">&copy; {{ date('Y') }} PrintMyPVC. All Rights Reserved.</p>
        </div>
        <div>
            <ul class="flex space-x-4">
                <li>
                    <a href="{{ route('privacypolicy') }}" class="text-white hover:underline">Privacy Policy</a>
                </li>
                <!-- <li>
                    <a href="#" class="text-white hover:underline">Terms of Service</a>
                </li>
                <li>
                    <a href="#" class="text-white hover:underline">FAQ</a>
                </li> -->
            </ul>
        </div>
        <div>
            <p class="text-lg">Contact us: <span class="font-semibold">support@printmypvc.com</span></p>
        </div>
    </div>
</footer>