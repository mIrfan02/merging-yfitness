@extends('layouts/default')

{{-- Page title --}}
@section('title')
    Home
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <!-- CSS Part Here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@stop

{{-- Page content --}}
@section('content')

    <div class="container">
            <h3>Terms and Conditions</h3>
            <div class="prize-description">
                <p>
                        <span style="color: rgb(74, 74, 74);">Welcome to </span><a href="http://www.ounass.com/" rel="noopener noreferrer" target="_blank" style="color: black;">www.Ebigwin.com</a><span style="color: rgb(74, 74, 74);">, the definitive home of luxury. We strive to ensure our customers receive an effortless shopping experience and we hope that you enjoy all our website has to offer.</span></p><p><a href="http://www.ounass.com/" rel="noopener noreferrer" target="_blank" style="color: black;">www.Ebigwin.com</a><span style="color: rgb(74, 74, 74);"> (the </span><strong style="color: rgb(74, 74, 74);">"Website"</strong><span style="color: rgb(74, 74, 74);">) is owned and operated by Electronic big win LLC trading as Ebigwin, for its own benefit and the benefit of its affiliates and subsidiaries (together “we" or “us") in the United Arab Emirates. Electronic big win LLC is a limited liability company incorporated under the laws of the United Arab Emirates, </span>With business license number CN-3748352 and its registered in TAJER ABU DHABI, United Arab Emirates.</p><h2><span style="color: rgb(74, 74, 74);">Website Terms</span></h2><p><span style="color: rgb(74, 74, 74);">Please read these Terms and any other terms of use posted on the Website as together they form our Website Terms governing your utilization of our Website and Website services (including the Website Call Centre and Mobile application). We may change these Website Terms from time to time without notice to you by posting the updated Website Terms on the Website, so please be sure to check regularly for updates. When you place an Order through our Website, you are deemed to have consented to the latest version of the Website Terms then posted on our Website. If a change in law means that we have to change our Website Terms after you have placed an Order but before it has been fulfilled, we are obliged to apply that change to your Order. In all other cases, the version posted at the time your Order was placed will apply. If you do not agree to be bound by the Website Terms, you should not use the Website.</span></p><h2><span style="color: rgb(74, 74, 74);">Eligibility</span></h2><p><span style="color: rgb(74, 74, 74);">We aim to make the Website and its associated services available to as many of you as possible. However, we do require that you are at least 18 years of age, able to lawfully: (i) make payment through one of our accepted tender types; (ii) agree to these Terms; and (ii) enter into binding Orders with us. In addition, only Orders with delivery addresses within the UAE can currently be processed via the UAE Website.</span></p><p><br></p><h2><span style="color: rgb(74, 74, 74);">Privacy &amp; Cookie Policy</span></h2><p><span style="color: rgb(74, 74, 74);">Please refer to our </span><a href="https://www.ounass.ae/privacy-policy/" rel="noopener noreferrer" target="_blank" style="color: black;">Privacy &amp; Cookie Policy</a><span style="color: rgb(74, 74, 74);"> for details on how we deal with your data.</span></p><h2><span style="color: rgb(74, 74, 74);">Orders</span></h2><p><span style="color: rgb(74, 74, 74);">When you place an Order with us, then subject to your rights to cancel or return the items, you commit to buy the items described in that Order, at the price indicated including any delivery fees, taxes and duties where applicable.</span></p><p><span style="color: rgb(74, 74, 74);">Orders are subject to our acceptance, which we may withhold in our sole discretion including for reasons such as ineligibility, inability to confirm payment authorization, suspected fraud, shipping restrictions and stock availability. Items in your Website basket are not reserved until your Order is paid for.</span></p><p><span style="color: rgb(74, 74, 74);">The Website may contain or provide information regarding the availability of merchandise. This information can be used to estimate the likelihood that an item will be available immediately upon Order placement. Unfortunately, we cannot guarantee that an item stated to be available will actually be available right away, as inventory can change significantly throughout the day. In rare cases, a product may be available when you place an Order but sold out by the time we process the Order. Should this happen, we will notify you.</span></p><p><span style="color: rgb(74, 74, 74);">Receipt of your Order will be acknowledged by email. However the Order is only confirmed when you receive a notification from us confirming dispatch of the relevant item(s). No party other than us has the authority to confirm acceptance of the Order.</span></p><h2><span style="color: rgb(74, 74, 74);">Payment</span></h2><p><span style="color: rgb(74, 74, 74);">We currently accept the following tender types for Orders placed on our Website: Visa, Mastercard, American Express, PayPal, Apple Pay, Cash on Delivery and online credit. Cash on Delivery is permitted for Orders of up to 50,000 AED. Payment will be taken at the time you place your Order. By entering payment details onto our Website, you warrant that you are duly authorized to pay using those details. We reserve the right to decline orders without liability to you where we believe payments are not authorized, the payment method is not valid or where we do not think you are authorized to use to utilize the relevant tender type.</span></p><p><span style="color: rgb(74, 74, 74);">Ebigwin provides all possible payment options for our customer's convenience. For payments made via Credit Card, Debit Card or Apple Pay, we may request additional personal documents, such as a passport copy or ID card with photo, in order to confirm your order. This is required to verify the identity of the buyer and protect the cardholder against any possibility of fraudulent payments. Ebigwin reserves the right to suspend or terminate the payment options available on your account and refuse any and all current or future use of the payment options available on the site (or any portion thereof) if it suspects there is fraudulent or suspicious activity. The Website is not liable or bound to inform or send specific communication to the user regarding the changes to your payment options on the website (or any portion thereof). It is the customer’s responsibility to get in touch with Ebigwin in order to get the payment options reactivated.</span></p><h2><span style="color: rgb(74, 74, 74);">Prices</span></h2><p><span style="color: rgb(74, 74, 74);">Prices on the Website are displayed in AED, and exclude any services you may elect to pair the purchase with, delivery costs, taxes or duties to which the purchase may be subject. Any such additional costs will be displayed before your final check out.</span></p><p><span style="color: rgb(74, 74, 74);">Where you purchase using a payment card denominated in a different currency to AED, the payment will be subject to the currency exchange rate applied by your card issuer at the time your payment is completed.</span></p><p><span style="color: rgb(74, 74, 74);">The destination you ask us to deliver to, the items &amp; services you select and the method of delivery you choose will dictate what delivery charges, taxes and duties apply (if any). Please refer to our Delivery section for further details on delivery options.</span></p><p><span style="color: rgb(74, 74, 74);">&nbsp;</span></p><h2><span style="color: rgb(74, 74, 74);">Order Delivery</span></h2><p><span style="color: rgb(74, 74, 74);">Ebigwin delivers across the GCC, with the delivery methods outlined below. We’re constantly striving to improve your experience, and are working on introducing more delivery methods across our channels. Kindly continue checking back for any updated. Deliveries take place between 9:00am - 11:59pm. The following options are available for delivery to your requested address in the UAE.* Orders above 500 AED qualify for free shipping, with the exception of same-day delivery in the UAE: </span></p><p><span style="color: rgb(74, 74, 74);">&nbsp;</span></p><p><span style="color: rgb(74, 74, 74);">* Orders placed outside of working hours (9am-8pm), after the cut-off time and/or during any UAE public holiday will be deemed placed on the first UAE working day following the Order's submission. Delivery timelines are estimates, see further details below. Order delivery may face delays during promotional activity, sale season and bank holidays — during this time, 2-hour delivery and next-day delivery may not be available. We reserve the right to impose a re-delivery charge where your Order is not accepted at the address supplied to us on the confirmed date of delivery. Please note that orders paid for by Cash on Delivery attract a 25 AED delivery fee.</span></p><h2><span style="color: rgb(74, 74, 74);">Returns and Exchanges</span></h2><h3><span style="color: rgb(74, 74, 74);">Ordinary Returns</span></h3><p><span style="color: rgb(74, 74, 74);">Subject to meeting the conditions set out in this Returns and Exchanges section, we offer a “no questions asked" free returns policy which allows you to return delivered items to us for any reason up to 30 days from delivery of your Order, free of charge.</span></p><h3><span style="color: rgb(74, 74, 74);">Refund Process</span></h3><p><span style="color: rgb(74, 74, 74);">Refunds will only be processed after the item/s returned have been approved. After approval, we will issue a refund of the full face value of undamaged items duly returned (excluding, where applicable, the original delivery charges and cash handling fees).</span></p><p><span style="color: rgb(74, 74, 74);">Your refund will be processed via the following methods:</span></p><ul><li>If you chose to pay with multiple payment methods, the store credit amount used will be prioritized and refunded in full, before the remainder of the payment gets refunded via the other payment method used. The refund will be processed in the following order: (i) The full store credit amount used will be credited back to your account (ii) The remaining amount will be refunded via your other payment method: Credit Card payments will be refunded to the Credit Card used to purchase your order, PayPal payments will be refunded to your PayPal account, and Amber Points and Cash on Delivery payments will be refunded as store credit.</li></ul><h3><span style="color: rgb(74, 74, 74);">Damaged Goods/Incorrectly-Fulfilled Orders</span></h3><p><span style="color: rgb(74, 74, 74);">If an item in your Order is received damaged by you or is not what you ordered, then please arrange for return of the item to us using the Returns Process. The item must be returned in the same condition you received it in within 30 days of receipt for a full refund including, where applicable, original Order delivery charges, cash handling fees, taxes and any duties. Replacement may be available. Defective items may also benefit from a manufacturer’s defects warranty.</span></p><p>&nbsp;Please contact us on customercare@ebigwin.com if you believe your goods have a manufacturing defect.</p><h3><span style="color: rgb(74, 74, 74);">Non-Returnable Items</span></h3><p><span style="color: rgb(74, 74, 74);">Beauty and grooming items (including skincare, fragrance, make-up and haircare), underwear, face masks and earrings cannot be returned. </span></p><h3><span style="color: rgb(74, 74, 74);">General Conditions Applicable to Returns</span></h3><p><span style="color: rgb(74, 74, 74);">In order to qualify for a refund, all items (including promotional gift items accompanying the Order) must be returned to us within 30 days of Order receipt:</span></p><ul><li>Unaltered, unused and in full saleable condition (or the condition in which they were received from us or our agents). Shoes must not have any sole or other damage;</li><li>In their original packaging/box/dust-cover and with all brand and product labels/tags/instructions still attached. Authenticity cards, where provided, should also be returned. Swimwear must have the original hygiene liner attached</li><li>Accompanied by the original Order confirmation.</li></ul><p><span style="color: rgb(74, 74, 74);">Please take care to preserve the condition of any product packaging as, for example, damaged shoe boxes may prevent re-sale and may mean that we cannot give you a full refund. Our agents may ask to inspect returned items at the point of collection but that initial inspection does not constitute a guarantee of your eligibility for a full refund.</span></p><p><span style="color: rgb(74, 74, 74);">We don’t accept returns for beauty products (including skincare, haircare, make-up, perfume), underwear, earrings. Unless the product has been damaged during shipping and retains its original packaging.</span></p><p><span style="color: rgb(74, 74, 74);">We regret but we cannot offer returns on the following categories of products: products not purchased via the Website/Website including </span><a href="http://www.ounass.com/" rel="noopener noreferrer" target="_blank" style="color: black;">www.Ebigwin.com</a><span style="color: rgb(74, 74, 74);"> sales originated outside of the United Arab Emirates. </span></p><p><span style="color: rgb(74, 74, 74);">We reserve the right to monitor returns and to refuse Orders from customers with excessive returns levels. However nothing in this Returns section is intended to affect any consumer rights that you may have under UAE law.</span></p><h2><span style="color: rgb(74, 74, 74);">Exchanges</span></h2><p><span style="color: rgb(74, 74, 74);">We are not currently able to offer Exchanges. Instead, all items should follow the returns process, and a new Order placed for the replacement items.</span></p><h2><span style="color: rgb(74, 74, 74);">Manufacturing Defects</span></h2><p><span style="color: rgb(74, 74, 74);">In addition to our 30 day returns policy, certain product items may benefit from a manufacturer’s warranty. </span></p><p>Please contact us on customercare@ebigwin.com if you believe your goods have a manufacturing defect.</p><h2><span style="color: rgb(74, 74, 74);">Product Liability</span></h2><p><span style="color: rgb(74, 74, 74);">By placing an Order through our Website, you acknowledge and agree that full liability for the products rests with the manufacturer and that we carry no product liability for those items save as described in the Returns section in relation to returning the products and refunding the price paid (where applicable).</span></p><h2><span style="color: rgb(74, 74, 74);">Title to Goods</span></h2><p><span style="color: rgb(74, 74, 74);">Title to the items in your Order will pass to you on the later of the day on which: (i) you pay us in full for those items; or (ii) the day you receive the items. Risk in the items in your Order passes to you on delivery to the address detailed in the Order.</span></p><h2><span style="color: rgb(74, 74, 74);">Intellectual Property Rights</span></h2><p><span style="color: rgb(74, 74, 74);">Your use of the Website and its contents does not grant you any copyright, design, trademark or other intellectual property rights relating to the Content (as described in the Content section below), including our software, HTML or other code contained in the Website. All such Content including third party trademarks, designs, and related intellectual property rights mentioned or displayed on this Website is typically protected by national and international intellectual property laws and treaties. You are permitted to use the Content only as expressly authorized by us or the licensor of such Content. Any reproduction or redistribution of the Content is prohibited and may result in civil and criminal penalties. Without limiting the foregoing, linking, commercially exploiting, copying and use of the above listed materials on any other server, location or support for publication, reproduction or distribution is expressly prohibited. However, you are permitted to make one copy for the purposes of viewing Content for your own personal use.</span></p><h2><span style="color: rgb(74, 74, 74);">Content</span></h2><p><span style="color: rgb(74, 74, 74);">In addition to the Intellectual Property rights mentioned above, "Content" is defined as any graphics, photographs, including all image rights, sounds, music, video, audio or text on this Website. We have made every effort to ensure that the information on the Website accurate and complete but we cannot promise that Content is error-free. We also do not promise that the functional aspects of the Website or Content will be error free or that this Website or the servers that make them available are free of viruses or other harmful components. We always recommend that you have up to date virus checking software installed.</span></p><h2><span style="color: rgb(74, 74, 74);">User Generated Content</span></h2><p><span style="color: rgb(74, 74, 74);">By providing a review you agree to be solely responsible for the content of all information you contribute. You also grant us a right to use any content you provide for our own purposes including republication in any form or media. Comments may be moderated and may not be displayed immediately but we do not commit to checking all content and will not be liable for third party posts. If you have a complaint about any posts, please contact us on</span><span style="color: black;"> </span><u style="color: black;">customercare@ebigwin.com</u><span style="color: rgb(74, 74, 74);">. We reserve the right in our sole discretion not to publish or to remove any comment including those that we believe may be unlawful, defamatory, racist or libelous, incite hatred or violence, detrimental to people, institutions, religions or to people's privacy, which may cause harm to minors, is detrimental to the trade marks, patents and copyrighted content, contains personal data, improperly uses the medium for promoting and advertising businesses. This Website is available to the public and therefore information you consider confidential should not be posted to this Website.</span></p><h2><span style="color: rgb(74, 74, 74);">Third Party Sites</span></h2><p><span style="color: rgb(74, 74, 74);">Our Website may include hyperlinks to other websites or resources operated by third parties. We are not responsible for the content or accuracy of any pages that are not on our Website or their availability. We do not endorse and are not liable, directly or indirectly, for the privacy policies of such websites, including (without limitation) any advertising, products or other materials or services on or available from such websites or resources, nor for any damage, loss or offence caused by, or in connection with, the use of or reliance on any such content, goods or services available on such external websites or resources.</span></p><h2><span style="color: rgb(74, 74, 74);">Descriptions</span></h2><p><span style="color: rgb(74, 74, 74);">At the time of publication on our Website, all product descriptions are believed to be accurate. We also strive to represent the products on our Website as accurately as possible, however colours and resolution may vary depending on your monitor’s display. All measurements and weights are approximate.</span></p><h2><span style="color: rgb(74, 74, 74);">No Warranty</span></h2><p><span style="color: rgb(74, 74, 74);">Except as otherwise provided in these Website Terms or required by applicable law, we make no representation, covenant or warranty and offer no other conditions, express or implied, regarding any matter, including, without limitation, the merchantability, suitability, fitness for a particular use or purpose, or non-infringement of Website membership, any Content, or any products purchased through the Website.</span></p><p><span style="color: rgb(74, 74, 74);">Your use of the Website is at your sole risk and it is provided on an "as is" and "as available" basis. We reserve the right to restrict or terminate your access to the Website at any time. Save as required by law, we make no warranties that access to the Website will be uninterrupted or error-free; that the Website will be secure; that the Website or the server that makes the site available will be virus-free; or that information on the site will be correct, accurate, adequate, useful, timely, reliable or otherwise complete. If you download any content from the Website, you do so at your own discretion and risk. You will be solely responsible for any damage to your computer or loss of data that results from the download of any such content. No advice or information obtained by you from the Website shall create any warranty of any kind.</span></p><h2><span style="color: rgb(74, 74, 74);">Liability</span></h2><p><span style="color: rgb(74, 74, 74);">Save for death or personal injury arising out of our negligence or as required by law, under no circumstances shall we, our affiliates, employees, directors, officers, agents or suppliers be liable to you or to any other person for any indirect, special, incidental or consequential losses or damages of any nature arising out of or in connection with the use of or inability to use the Website, including, without limitation, damages for loss of profits, loss of goodwill or loss of data. Without prejudice to the foregoing, in no event will we be liable for any amounts in excess of the amount paid by you for the product(s) in respect of which the claim arose.</span></p><p><span style="color: rgb(74, 74, 74);">Nothing in this Agreement is intended to impact any rights you or we may have under applicable law. We are committed to respecting individual rights including but not limited to moral, cultural and religious rights as enshrined in applicable law.</span></p><h2><span style="color: rgb(74, 74, 74);">Entire Agreement</span></h2><p><span style="color: rgb(74, 74, 74);">You acknowledge and agree that these Website Terms constitute the complete and exclusive agreement between us concerning your use of the Website and any purchase by you of any items through the Website, and supersede and govern all prior proposals, agreements, or other communications.</span></p><h2><span style="color: rgb(74, 74, 74);">No Agency</span></h2><p><span style="color: rgb(74, 74, 74);">Nothing contained in these Website Terms shall be construed as creating any agency, partnership, or other form of joint enterprise between us.</span></p><h2><span style="color: rgb(74, 74, 74);">No Waiver</span></h2><p><span style="color: rgb(74, 74, 74);">Any failure to exercise or any delay by either party in exercising its rights or remedies under these Website Terms shall not be construed as a waiver thereof. The rights and remedies provided by these Terms are cumulative and are not exclusive of any rights or remedies provided by law.</span></p><h2><span style="color: rgb(74, 74, 74);">Illegality</span></h2><p><span style="color: rgb(74, 74, 74);">If any provision of these Website Terms is held to be illegal or unenforceable, the remaining Website Terms (or parts thereof) will not be affected and will remain in full force and effect.</span></p><h2><span style="color: rgb(74, 74, 74);">Language</span></h2><p><span style="color: rgb(74, 74, 74);">These Website Terms are published in English and Arabic. If there is any inconsistency between the English text and the Arabic text, the English text will apply.</span></p><h2><span style="color: rgb(74, 74, 74);">Disputes and Governing Law</span></h2><p><span style="color: rgb(74, 74, 74);">These Website Terms are governed by the federal laws of the United Arab Emirates and the laws of the Emirate of Dubai and all disputes arising here under are subject to the exclusive jurisdiction of the courts of Dubai, United Arab Emirates.</span>
                </p>
            </div>
        </div>
@stop


{{-- page level scripts --}}
@section('footer_scripts')

@stop