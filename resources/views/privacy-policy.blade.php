<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel E-commerce Website') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Ensure the body takes up at least the full viewport height. */
        }

        main {
            flex-grow: 1;
            /* Allow the main content to grow and push the footer to the bottom. */
        }

        .privacy-policy {
            margin: 20px;
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .privacy-policy strong {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .privacy-policy p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        /* Style links within the privacy policy */
        .privacy-policy a {
            color: #007bff;
            /* Blue color for links */
            text-decoration: underline;
        }

        .privacy-policy a:hover {
            text-decoration: none;
            /* Remove underline on hover */
        }
    </style>
</head>

<body>
    @include('layouts.navigation')
    <div class="privacy-policy">
        <strong>Privacy Policy</strong>
        <p>
            NameofOwner built the PrintMyPVC app as
            a Commercial app. This SERVICE is provided by
            NameofOwner and is intended for use as
            is.
        </p>
        <p>
            This page is used to inform visitors regarding my
            policies with the collection, use, and disclosure of Personal
            Information if anyone decided to use my Service.
        </p>
        <p>
            If you choose to use my Service, then you agree to
            the collection and use of information in relation to this
            policy. The Personal Information that I collect is
            used for providing and improving the Service. I will not use or share your information with
            anyone except as described in this Privacy Policy.
        </p>
        <p>
            The terms used in this Privacy Policy have the same meanings
            as in our Terms and Conditions, which are accessible at
            PrintMyPVC unless otherwise defined in this Privacy Policy.
        </p>
        <p><strong>Information Collection and Use</strong></p>
        <p>
            For a better experience, while using our Service, I
            may require you to provide us with certain personally
            identifiable information. The information that
            I request will be retained on your device and is not collected by me in any way.
        </p> <!---->
        <p><strong>Log Data</strong></p>
        <p>
            I want to inform you that whenever you
            use my Service, in a case of an error in the app
            I collect data and information (through third-party
            products) on your phone called Log Data. This Log Data may
            include information such as your device Internet Protocol
            (“IP”) address, device name, operating system version, the
            configuration of the app when utilizing my Service,
            the time and date of your use of the Service, and other
            statistics.
        </p>
        <p><strong>Cookies</strong></p>
        <p>
            Cookies are files with a small amount of data that are
            commonly used as anonymous unique identifiers. These are sent
            to your browser from the websites that you visit and are
            stored on your device's internal memory.
        </p>
        <p>
            This Service does not use these “cookies” explicitly. However,
            the app may use third-party code and libraries that use
            “cookies” to collect information and improve their services.
            You have the option to either accept or refuse these cookies
            and know when a cookie is being sent to your device. If you
            choose to refuse our cookies, you may not be able to use some
            portions of this Service.
        </p>
        <p><strong>Service Providers</strong></p>
        <p>
            I may employ third-party companies and
            individuals due to the following reasons:
        </p>
        <ul>
            <li>To facilitate our Service;</li>
            <li>To provide the Service on our behalf;</li>
            <li>To perform Service-related services; or</li>
            <li>To assist us in analyzing how our Service is used.</li>
        </ul>
        <p>
            I want to inform users of this Service
            that these third parties have access to their Personal
            Information. The reason is to perform the tasks assigned to
            them on our behalf. However, they are obligated not to
            disclose or use the information for any other purpose.
        </p>
        <p><strong>Security</strong></p>
        <p>
            I value your trust in providing us your
            Personal Information, thus we are striving to use commercially
            acceptable means of protecting it. But remember that no method
            of transmission over the internet, or method of electronic
            storage is 100% secure and reliable, and I cannot
            guarantee its absolute security.
        </p>
        <p><strong>Links to Other Sites</strong></p>
        <p>
            This Service may contain links to other sites. If you click on
            a third-party link, you will be directed to that site. Note
            that these external sites are not operated by me.
            Therefore, I strongly advise you to review the
            Privacy Policy of these websites. I have
            no control over and assume no responsibility for the content,
            privacy policies, or practices of any third-party sites or
            services.
        </p>
        <p><strong>Children’s Privacy</strong></p> <!---->
        <div>
            <p>
                I do not knowingly collect personally
                identifiable information from children. I
                encourage all children to never submit any personally
                identifiable information through
                the Application and/or Services.
                I encourage parents and legal guardians to monitor
                their children's Internet usage and to help enforce this Policy by instructing
                their children never to provide personally identifiable information through the Application and/or Services without their permission. If you have reason to believe that a child
                has provided personally identifiable information to us through the Application and/or Services,
                please contact us. You must also be at least 16 years of age to consent to the processing
                of your personally identifiable information in your country (in some countries we may allow your parent
                or guardian to do so on your behalf).
            </p>
        </div>
        <p><strong>Changes to This Privacy Policy</strong></p>
        <p>
            I may update our Privacy Policy from
            time to time. Thus, you are advised to review this page
            periodically for any changes. I will
            notify you of any changes by posting the new Privacy Policy on
            this page.
        </p>
        <p>This policy is effective as of 2023-10-15</p>
        <p><strong>Contact Us</strong></p>
        <p>
            If you have any questions or suggestions about my
            Privacy Policy, do not hesitate to contact me at PrintMyPVC@gmail.com.
        </p>

    </div>
    <!-- Toast -->
    <div x-data="toast" x-show="visible" x-transition x-cloak @notify.window="show($event.detail.message, $event.detail.type || 'success')" class="fixed w-[400px] left-1/2 -ml-[200px] top-16 py-2 px-4 pb-4 text-white" :class="type === 'success' ? 'bg-emerald-500' : 'bg-red-500'">
        <div class="font-semibold" x-text="message"></div>
        <button @click="close" class="absolute flex items-center justify-center right-2 top-2 w-[30px] h-[30px] rounded-full hover:bg-black/10 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <!-- Progress -->
        <div>
            <div class="absolute left-0 bottom-0 right-0 h-[6px] bg-black/10" :style="{'width': `${percent}%`}"></div>
        </div>
    </div>
    <!--/ Toast -->
    @include('layouts.footer')
</body>

</html>