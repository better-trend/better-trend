@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')
<!-- Start main-content -->
<div class="main-content">
   <!-- Section: inner-header -->
   <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="/frontend/_assets/images/breadcrumb-bg.png">
      <div class="container pt-70 pb-20">
         <!-- Section Content -->
         <div class="section-content">
            <div class="row">
               <div class="col-md-12">
                  <ol class="breadcrumb text-right text-black mb-0 mt-40">
                     <li><a href="{{ lang_url('') }}">@t('Home')</a></li>
                     <li class="active text-gray-silver">@t('Policy and Terms of Use')</li>
                  </ol>
                  <h2 class="title text-white">@t('Policy and Terms of Use')</h2>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Divider: about -->
   <section class="divider">
      <div class="container">
         <div class="row pt-30 <?= (request()->segments()[0] == "ar" ? "rtl" : "ltr") ?>">
            <div class="col-md-12">
               <?php if (request()->segments()[0] == "en") :  ?>
               <h3>Our trade room and/or chat room is provided for educational purposes only.</h3>
               Any trades placed upon reliance of the BetterTrend.Net services are taken at your own risk for your own account. Past performance is no guarantee of future results. While there is great potential for reward when trading commodity futures, there is also substantial risk of loss in all commodity futures trading. You must decide your own suitability to trade. Future trading results can never be guaranteed. This is neither a solicitation nor an offer to Buy/Sell futures or options.
                
               The methods taught at BetterTrend.Net are based on historical formulas which have worked in the past. However, what has happened before may or may not happen again. You can lose all of your money trading and you must decide your own suitability as to whether or not to trade. Only trade with true risk capital you can afford to lose. Only trade markets you can properly afford to trade. Properly funded trading accounts typically perform better than those that are not properly funded.
                
               All mention of trading is for educational purposes only and is not to be construed as an offer to buy/sell in any financial market. By reading this, you hereby agree that you will not make actual trades based on any information, educational alerts or triggers that are posted in any education, via email, or discussed via audio/video/text in the trade room and/or chat room or on social media online. BetterTrend.Net is not a financial advisory service. Note that all of our posts are for educational purposes only; per CFTC/SEC and CMA in Saudi Arabia guidelines we do not give investment advice, nor promote the buying/selling of any specific stocks, Forex, futures, or options contract(s). Traders assume full liability for a ll trading risks and outcomes. The service, for which you are enrolling, sole purpose, is training. We are an online educational source for learning to trade futures.
               BetterTrend.Net and all partners and/or their employees and associates are not responsible for any loss or profit. The chat room and trade room is for online educational purposes only. It is not to be misunderstood as a trading room, such as a room giving signals for trading real money. We request that our students follow our trades using a simulator as we do when we recognize trading opportunities. Please do not misunderstand our services. The trade room is meant to educate students using current market data. Do your own due diligence and consult with a qualified broker or registered investment advisor (which we are not) prior to making any trades. You assume all risk and liability for all trades that you make.
                
               The BetterTrend.Net trading method is not investment advice. We have no financial interest in the outcome of any trades mentioned herein. There is substantial risk of loss trading financial markets. You need to determine your own suitability to trade them. There may be tax consequences for short term profit/loss on trades. Consult your tax advisor for details on this, if applicable.
                
               Neither BetterTrend.Net, nor its principals, officers or employees are commodity trading advisors, which means that we do not direct client accounts or provide commodity trading advice based on, or tailored to, the commodity interest or cash positions or other circumstances or characteristics of particular clients. Becoming a subscriber and/or trading the BetterTrend.Net method presumes that you have fully read and understood the risks involved in trading futures/commodities as set forth below, and agree that you have received a copy of the Consent Order that is available from the National Futures Association’s web site at: http://www.nfa.futures.org/Restitution/Orders/unitedbusiness.pdf.
                
               There are no guarantees or certainties in trading. Reliability of trading signals for mechanical systems is in probabilities only. Trading involves hard work, risk, discipline and the ability to follow rules and trade through any tough periods during system draw-downs. If you are looking for guarantees, trading is not for you. Most people lose money when trading. One of the reasons is that they lack discipline and are unable to be consistent. A system can help you become consistent. The ability to be disciplined and take the trades is equally as important as any technical indicators a trader uses. Ironically, worrying ab out the money aspect of trades can contribute to and cause a trader to make trading errors. Therefore, it is important to only trade with true risk capital.
                
               <h3>Additional Notices</h3>
                
               ALL OF THE INFORMATION, SOFTWARE, CONTENT, PRODUCTS AND SERVICES AT BetterTrend.Net ARE PROVIDED ON AN "AS-IS" AND "AS-AVAILABLE" BASIS, WITH NO WARRANTIES OF ANY KIND. BetterTrend.Net EXPRESSLY DISCLAIMS ANY AND ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NONINFRINGEMENT. BetterTrend.Net DISCLAIMS ANY WARRANTY THAT THE SITE WILL ALWAYS BE ACCESSIBLE OR OPERATIONAL, THAT THE INFORMATION PROVIDED ON THE SITE IS ACCURATE, RELIABLE OR CORRECT, AND THAT ANY ERRORS WILL BE CORRECTED. YOU AGREE THAT, UNDER NO CIRCUMSTANCES AND TO THE FULLEST EXTENT ALLOWED BY APPLICABLE LAW, BetterTrend.Net WILL NOT BE LIABLE FOR ANY AND ALL DAMAGES UNDER ANY AND ALL THEORIES (INCLUDING CONTRACT, NEGLIGENCE, STRICT LIABILITY OR TORT) ARISING OUT OF OR RELATING IN ANY WAY TO THIS AGREEMENT, THE CONTENT, INCLUDING WITHOUT LIMITATION ANY BetterTrend.Net CONTENT OR THIRD PARTY CONTENT, THE SITE, YOUR USE OR INABILITY TO USE THE SITE, OR ANY DECISION OR ACTION YOU MAKE IN CONNECTION WITH THE SITE. YOU AGREE THAT, UNDER NO CIRCUMSTANCES AND TO THE FULLEST EXTENT ALLOWED BY APPLICABLE LAW, THE MAXIMUM AGGREGATE LIABILITY, IF ANY, THAT BetterTrend.Net MAY OWE TO YOU IN CONNECTION WITH THIS AGREEMENT, THE SITE, AND YOUR USE OF THE SITE AND ITS CONTENT, SHALL NOT, UNDER ANY CIRCUMSTANCE OR THEORY OF LAW OR RECOVERY, EXCEED $100. YOUR ONLY OTHER REMEDY FOR DISSATISFACTION WITH THE SITE, SITE RELATED SERVICES OR CONTENT OR INFORMATION CONTAINED WITHIN THE SITE IS TO STOP USING THE SITE AND THE SERVICES OFFERED OR PROVIDED AND TO CANCEL YOUR SUBSCRIPTION.
                
               <h3>Subscription Agreement (when applicable)</h3>
                
               Subscribers agree to pay a monthly or annually subscription fee (as per the package purchased) and agree to the Terms of Use of the BetterTrend.Net web site. The Terms of Use govern the use of our web site by registered subscribers. Once you authorize BetterTrend.Net to charge your credit card for the monthly/annually fee and you register with BetterTrend.Net (registration constitutes your agreement to this Subscription Agreement and the Terms of Use), you will be given access to the secured web site.
                
               <h3>Cancelling Your Subscription</h3>
                
               If you wish to cancel your paid subscription with us, simply send us an email to Support@BetterTrend.Net to cancel your subscription at least 48 hours before the time of your expiration. Monthly or annually subscription fees which have been charged to your credit card in the past will not be refunded to you, in whole or in part. BetterTrend.Net has the right to cancel your subscription and terminate this agreement if you fail to observe any provision of this Subscription Agreement or any of the Terms of Use of our site. We also may cancel your subscription if authorized charges to your credit card are not honored, or if BetterTrend.Net is no longer authorized to charge your credit card. Upon cancellation, you will be denied further access to the restricted/members-only portion of the BetterTrend.Net web site. BetterTrend.Net will have no obligation to return any portion of the membership and/or subscription fees you have paid prior to cancellation.
                 
               <h3>Duration of Our Agreement</h3>
                
               By completing the sign up form you are authorizing BetterTrend.Net to charge your credit card for the specified one-time or recurring membership fee on behalf of BetterTrend.net
                
               Your membership does not have an expiration date, and BetterTrend.Net does not warrant any specific length of time that this membership will be valid, and/or the site remaining operational.
                
               BetterTrend.Net reserves the right to close its web site operations at any time without any recourse from its current members.
                
               <h3>Your Limited User License</h3>
                
               No subscriber or other user is allowed to copy, sell, license, modify, distribute, reproduce, transmit, publicly display, publicly perform, publish, adapt, edit, create any of the materials or Site Content on our web site or any derivative works from or use the Site Content, in whole or in part, except as is expressly authorized by this license.
                
               <h3>Confidentiality Agreement</h3>
                
               Materials available to members of BetterTrend.Net are confidential and may not be copied or transmitted at any time, under any circumstance. Members of BetterTrend.Net are prohibited from sharing our course materials, methods and trade signals with non-members of BetterTrend.Net.
                
               <h3>Prohibited Postings and Comment</h3>
                
               You agree that you will refrain from any offensive, defamatory, vulgar, obscene, political or racial remarks and comments, and will not make any personal attacks, use any offensive or inappropriate language, post material that is harmful to minors, engage in any hyping or front running, or place or post on the site any "spam," advertisements or promotional material. BetterTrend.Net reserves the right to deny posting privileges or other access privileges, including without limitation revocation and cancellation of subscription, or terminating membership, for violating these conditions.
                
               You can be held liable for any illegal or prohibited Content you provide to the site, including, among other things, illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or other materials injurious to third parties. You can also be held liable for materials consisting of or containing software viruses, political campaigning, commercial solicitation, chain letters, mass mailings, or any form of "spam." You may not use a false e-mail address, impersonate any person or entity, or otherwise mislead as to the origin of content.
                
               You are prohibited from using the BetterTrend.Net name without prior written consent from our administrator.
                
               In the trade room and/or chat room, you agree to refrain from asking any and all business and or personal questions directly of BetterTrend.Net at any time. However, you may direct those questions by e-mail to Support@BetterTrend.Net.
                
               <h3>Your Obligation to Indemnify Us</h3>
                
               You agree to indemnify, defend and hold harmless BetterTrend.Net and its officers, directors, employees, agents, partners, information providers and suppliers from and against all claims, causes of action, suits, losses, expenses, damages and costs, including reasonable attorney's fees, arising out of, in connection with or relating to any violation by you of the Subscription Agreement or these Terms of Use, including claims of infringement of intellectual property or other third party rights, or otherwise, directly or indirectly resulting from or attributable in any way to any access to, use of or posting of material or content on the BetterTrend.Net web site by you.
                
               <h3>Access and Interference</h3>
                
               You agree that you will not use any robot, spider, other automatic device, or manual process to monitor or copy our web pages or the Content contained thereon or for any other unauthorized purpose without our prior expressed written permission. You agree that you will not use any device, software or routine to interfere or attempt to interfere with the proper working of the web site. You agree that you will not take any action that imposes an unreasonable or disproportionately large load on our infrastructure. Further, you agree not to engage in any unauthorized framing, linking or deep-linking to the web site without the prior written consent of BetterTrend.Net.
                
               <h3>Other Terms, Conditions and Provisions</h3>
                
               The Subscription Agreement and these Terms of Use together constitute an additional agreement between you and BetterTrend.Net and the prior agreement between you and BetterTrend.Net will remain in effect.
                
               The Subscription Agreement and the limited license granted to you are personal to you, and may not be assigned or transferred by you to anyone else. You also agree that you will not allow anyone else to access the BetterTrend.Net members-only area unless such other person has registered as a subscriber. You agree that you will be solely responsible for any liability arising from any third party access to or use of the site that you permit or facilitate. You agree that you will lose your course membership and all access to course materials if they are given to a non-member of any sort, and there are no refunds for your enrollment fee if this occurs. All materials are for MEMBERS ONLY.
                
               This Agreement shall be governed by and construed in accordance with Saudi Arabia law. You agree that your use of BetterTrend.Net constitutes activity in Saudi Arabia and for the purpose of litigating any dispute arising under this Agreement, you agree that any action commenced against BetterTrend.Net shall be commenced and maintained solely in a Saudi court of competent subject matter jurisdiction within Saudi Arabia. You also agree to submit and consent to the personal jurisdiction and venue of any such court in the event BetterTrend.Net commences an action against you.
                
               If any term or provision of the Subscription Agreement or of these Terms of Use is finally found by a court of competent jurisdiction to be void, invalid, unenforceable or otherwise contrary to law, the remainder of the Subscription Agreement or Terms of Use, as the case may be, that can be given effect without such term or provision, shall be given full effect.
                
               Any failure by BetterTrend.Net to enforce strict performance of any provision of the Subscription Agreement or the Terms of Use will not constitute a waiver of its right subsequently to enforce such provision or any other provision of the Subscription Agreement or Terms of Use.
                
               <h3>How to Become a Subscriber</h3>
                
               To become a subscriber, you must be at least 18 years of age and will have to complete the Sign-Up Form. If you register, you will be required to pay a one-time or recurring membership fee and will be making certain promises and agreements and will be legally obligated to observe the terms and conditions of our Subscription Agreement and the Terms of Use of the BetterTrend.Net web site, which follow. Please read them before completing the Sign-Up Form.
                
               Please be aware that as a subscriber you are purchasing the access to our online educational materials. You are purchasing access to information, education, and training to become a professional trader. You are not purchasing software, and there is no guarantee you will make income. All subscribers are given access to protected web pages, videos, and downloadable files within our web site’s course materials. Subscribers will use these materials to learn how to trade as a professional at their own risk.
                
               As a subscriber you agree that you are aware of EXACTLY what you are purchasing.
                
               <h3>Interest in Securities or Commodities</h3>
                
               From time to time, BetterTrend.Net moderators may take positions and/or buy or sell securities or commodities that are discussed in the trade room.
                
               <h3>Delivery Method</h3>
                
               All Online Course Materials are available as a combination of protected web pages, downloadable documents and online videos. The Advanced membership is a one-time payment; there are no recurring or monthly charges, unless you choose to do a payment plan.
                
               <h3>Privacy Policy</h3>
                
               A BetterTrend.Net collects personal information regarding our clients through our email newsletter registration, and our membership registration. We collect your name and e-mail address only if you are a newsletter-only subscriber. When you register for a membership your name, address, and credit card information is needed to process your credit card, and this information is kept securely off-site by a regulated third-party provider to ensure your personal information is safe and secure, and only the necessary information to process the transaction is needed, and it is NEVER sold or shared with anyone else for any reason.
                
               BetterTrend.Net creates a record of each member's activity when they are inside the web site's members-only section. Your unique IP address, e-mail, and password is recorded when you register, and is kept on file on our servers. Please be aware that each time you log in to your membership section of the web site your IP address is being tracked, along with your activity on our web site.
                
               From time to time, BetterTrend.Net will send out information emails to its registered members. By registering for our mailing lists, or registering as a member of BetterTrend.Net you authorize us to send you e-mail, phone, and Skype correspondence. You may choose at any time to stop receiving these e-mails by simply selecting 'unsubscribe' in either the e-mail itself or within the account settings, or by writing us an e-mail asking to be removed: Support@BetterTrend.Net
                
               BetterTrend.Net does not sell, or otherwise share its e-mail list with any other companies or websites. BetterTrend.Net takes your personal privacy very seriously and does not share your information, public or private with anyone else.
                
               For legal reasons we may be required to disclose certain information to comply with the law, an investigation, or a legal process, such as a court order or subpoena, and we will notify you prior to releasing this information, if allowed by law.
                
               Disclosure of Material Connection
                
               You should assume the owner of this web site has an affiliate relationship and/or another material connection, to any suppliers of goods and services that may be discussed here, and may be compensated for showing ads or recommending products or services, or linking to the supplier’s web site.
                
               <h3>Company Information</h3>
                
               The parent company for BetterTrend.Net is Better Trend Inc.
                
               All payments will be made to Better Trend Inc. and your Credit Card statement will show as paid to Better Trend Inc0. All amounts shown on the web site are in Saudi Riyal, all payments made are in Saudi Riyal or US Dollar if mentioned.
                
               Contact Information: <br>
                
               Better Trend Inc. <br>
               Riyadh, xxxxx <br>
               xxx.xxxx.xxxx <br>
               Working times (During Normal Business Hours of xxxxxxx) <br>
               Support@BetterTrend.Net <br>
                

                
               <h3>REFUND POLICY: ALL SALES ARE FINAL</h3>
                
               <ul>
                  <li>A client is not entitled to any refund whatsoever, whether or not he has used the product. Only in Training events that will be explained below.</li>
                  <li>A client has the right to replace a product if received in damaged or in a condition that prevents using it within 3 days of delivery date, a client should inform us during this time</li>
                  <li>In the case of Training events and the want to withdraw from one before more than 24 hours of the training starting date, the client can use the funds in any other events, or a fee of 50% will be debited from the fund for refund.</li>
                  <li>All materials contained on the web site and in course materials are protected by Copyright laws, BetterTrend.Net and its parent company will pursue copyright infringement to the full extent of the law.</li>
               </ul>
               <?php else : ?>

                  <h3>غرفة البث المباشر للتدريب والتداول والمحادثات تقدم لغرض التعليم فقط وليس التوصيات</h3>
                  <p>

                     أي صفقات يتم وضعها بناءً على الاعتماد على خدمات BetterTrend.Net تتم على مسؤوليتك الخاصة لحسابك الخاص. الأداء السابق لا يعتبر ضمانا للنتائج المستقبلية. في حين أن هناك إمكانية كبيرة للمكافأة عند تداول العقود الآجلة للسلع الأساسية ، هناك أيضًا خطر كبير للخسارة في جميع عمليات تداول العقود الآجلة للسلع. يجب أن تقرر مدى صلاحيتك للتداول. لا يمكن ضمان نتائج التداول المستقبلية. هذا ليس طلبًا أو عرضًا لشراء أو بيع العقود الآجلة أو الخيارات.
                     تعتمد الأساليب التي يتم تدريسها في BetterTrend.Net على الصيغ التاريخية التي عملت في الماضي. ومع ذلك ، ما حدث من قبل قد يحدث أو لا يحدث مرة أخرى. يمكنك أن تخسر كل ما تبذلونه من تداول الأموال ويجب أن تقرر مدى ملاءمتك فيما يتعلق بما إذا كنت تريد التداول أم لا. التجارة فقط مع رأس المال المخاطر الحقيقي الذي يمكن أن تخسره. يمكنك فقط التداول في الأسواق التي يمكنك التداول بها بشكل صحيح. حسابات التداول الممولة بشكل صحيح عادة ما تكون أفضل من تلك التي لا يتم تمويلها بشكل صحيح.
                      كل ذكر للتداول لأغراض تعليمية فقط ولا يجب تفسيره على أنه عرض للشراء / البيع في أي سوق مالي. من خلال قراءة هذا ، فإنك توافق بموجب هذا على أنك لن تجري تداولات فعلية بناءً على أي معلومات أو تنبيهات تعليمية أو مشغلات يتم نشرها في أي تعليم ، عبر البريد الإلكتروني ، أو مناقشتها عبر الصوت / الفيديو / النص في غرفة التجارة و / أو غرفة الدردشة أو على وسائل التواصل الاجتماعي عبر الإنترنت. BetterTrend.Net ليست خدمة استشارية مالية. لاحظ أن جميع منشوراتنا مخصصة للأغراض التعليمية فقط ؛ وفقًا لإرشادات CFTC / SEC و CMA في المملكة العربية السعودية ، فإننا لا نقدم نصيحة استثمارية ، ولا نشجع على شراء / بيع أي أسهم معينة أو فوركس أو العقود المستقبلية أو عقود (عقود) الخيارات. يتحمل المتداولون المسؤولية الكاملة عن مخاطر ونتائج التداول. الخدمة ، التي تقوم بالتسجيل فيها ، والغرض الوحيد ، هي التدريب. نحن مصدر تعليمي عبر الإنترنت لتعلم كيفية تداول العقود المستقبلية.
                     إن شركة BetterTrend.Net وجميع الشركاء و / أو موظفيهم وشركائهم ليسوا مسؤولين عن أي خسارة أو ربح. غرفة المحادثة وغرفة التجارة مخصصة للأغراض التعليمية عبر الإنترنت فقط. لا ينبغي أن يساء فهمها كغرفة تجارية ، مثل غرفة تعطي إشارات لتداول أموال حقيقية. نطلب من طلابنا متابعة تداولاتنا باستخدام جهاز محاكاة كما نفعل عندما نتعرف على فرص التداول. من فضلك لا تسيء فهم خدماتنا. تهدف غرفة التجارة إلى تثقيف الطلاب باستخدام بيانات السوق الحالية. قم بعمل العناية الواجبة والتشاور مع وسيط مؤهل أو مستشار استثمار مسجل (نحن لسنا) قبل القيام بأي صفقات. أنت تتحمل كل المخاطر والمسؤولية عن جميع الصفقات التي تقوم بها.
                      طريقة التداول BetterTrend.Net ليست نصيحة استثمارية. ليس لدينا مصلحة مالية في نتائج أي تداولات مذكورة هنا. هناك خطر كبير من خسارة الأسواق المالية التجارية. تحتاج إلى تحديد مدى ملاءمتها للتداول بها. قد تكون هناك عواقب ضريبية للأرباح / الخسائر قصيرة الأجل على الصفقات. استشر مستشار الضرائب للحصول على تفاصيل حول هذا ، إذا كان ذلك ممكنًا.
                      لا BetterTrend.Net أو مديريها أو موظفيها أو موظفيها هم مستشارون في تجارة السلع ، مما يعني أننا لا نوجه حسابات العملاء أو نوفر المشورة بشأن تداول السلع بناءً على ، أو تخصيصها ، لمصلحة السلع أو المراكز النقدية أو غيرها من الظروف أو خصائص عملاء معينين. أن تصبح أحد المشتركين و / أو المتداولين في طريقة BetterTrend.Net تفترض أنك قد قرأت وفهمت تمامًا المخاطر التي تنطوي عليها تجارة العقود الآجلة / السلع كما هو موضح أدناه ، وتوافق على أنك قد استلمت نسخة من أمر الموافقة المتاح من موقع الرابطة الوطنية للعقود الآجلة على: http://www.nfa.futures.org/Restitution/Orders/unitedbusiness.pdf.
                      لا توجد ضمانات أو يقين في التداول. موثوقية إشارات التداول للأنظمة الميكانيكية في الاحتمالات فقط. ينطوي التداول على العمل الجاد والمخاطر والانضباط والقدرة على اتباع القواعد والتداول خلال أي فترات صعبة أثناء سحب النظام. إذا كنت تبحث عن ضمانات ، فالتداول ليس لك. معظم الناس يخسرون المال عند التداول. أحد الأسباب هو أنها تفتقر إلى الانضباط وغير قادرة على أن تكون متسقة. يمكن للنظام أن يساعدك على أن تصبح متسقًا. القدرة على الانضباط وأخذ التداولات لا تقل أهمية عن أي مؤشرات فنية يستخدمها المتداول. ومن المفارقات أن القلق بشأن الجانب النقدي من التداولات يمكن أن يسهم في ارتكاب المتداول أخطاء تجارية ويسببها. لذلك ، من المهم أن تتداول فقط برأس مال خطر حقيقي. 
                  </p>
                  <h3>إشعارات إضافية </h3>
                  <p>
                     تم توفير جميع المعلومات والبرامج والمحتويات والمنتجات والخدمات في BetterTrend.Net على أساس "كما هو" و "كما هو متوفر" ، دون أي ضمانات من أي نوع. BetterTrend.Net تتنصل صراحةً من أي وجميع الضمانات ، سواء كانت صريحة أو ضمنية ، بما في ذلك على سبيل المثال لا الحصر ضمانات الرواج ، والصلاحية لغرض معين ، وعدم الملاءمة. BetterTrend.Net تتنصل من أي ضمان بأن الموقع سيكون متاحًا دائمًا أو تشغيليًا ، وأن المعلومات الواردة على الموقع دقيقة أو موثوقة أو صحيحة ، وأي أخطاء سيتم تصحيحها. أنت توافق على أنه ، دون أي شروط أو أقصى حد يسمح به القانون المعمول به ، فإن BetterTrend.Net لن تكون مسؤولة عن أي وجميع الأضرار التي تقع على أي من النظريات ، بما في ذلك العقد ، والضوابط القانونية الصارمة في أي طريقة من هذه الاتفاقية ، فإن المحتوى ، بما في ذلك على سبيل المثال لا الحصر ، أي محتوى من محتوى BetterTrend.Net أو محتوى الطرف الثالث أو الموقع أو استخدامك أو عدم قدرتك على استخدام الموقع أو أي قرار أو إجراء تتخذه بالموقع. أنت توافق على أنه بموجب أية شروط وأحكام الاستخدام المسموح بها بموجب القانون المعمول به ، يكون الحد الأقصى للمسؤولية المطلقة ، إن وجدت ، قد يكون موقع BetterTrend.Net متروكًا لك فيما يتعلق بهذا الاتفاق المحتوى ، لا ، تحت أي ظرف من الظروف أو نظرية القانون أو الاسترداد ، يتجاوز 100 دولار. إن وسيلة الانتصاف الخاصة بك فقط من أجل عدم الرضا عن الموقع أو الخدمات المتعلقة بالموقع أو المحتوى أو المعلومات الموجودة داخل الموقع هي إيقاف استخدام الموقع والخدمات المقدمة أو المقدمة وإلغاء اشتراكك.
                  </p>
                  <h3>اتفاقية الاشتراك (عند توفرها)</h3>
                  <p>
                     وافق المشتركون على دفع رسوم اشتراك شهرية أو سنوية (حسب الحزمة التي تم شراؤها) والموافقة على شروط الاستخدام لموقع الويب BetterTrend.Net. تتحكم شروط الاستخدام في استخدام موقعنا على الإنترنت من قبل المشتركين المسجلين. بمجرد تخويل BetterTrend.Net لشحن بطاقتك الائتمانية مقابل الرسوم الشهرية / السنوية والتسجيل في BetterTrend.Net (التسجيل يشكل موافقتك على اتفاقية الاشتراك وشروط الاستخدام) ، سيتم منحك حق الوصول إلى موقع الويب الآمن .
                      
                  </p>
                  <h3>إلغاء اشتراكك</h3>
                  <p>
                     إذا كنت ترغب في إلغاء اشتراكك المدفوع معنا ، ما عليك سوى إرسال بريد إلكتروني إلينا على العنوان التالي: Support@BetterTrend.Net  لإلغاء اشتراكك قبل 48 ساعة على الأقل من وقت انتهاء الصلاحية. لن يتم رد رسوم الاشتراك الشهرية أو السنوية التي تم فرضها على بطاقتك الائتمانية في الماضي لك كليًا أو جزئيًا. يحق لشركة BetterTrend.Net إلغاء اشتراكك وإنهاء هذه الاتفاقية إذا لم تلتزم بأي شرط من أحكام اتفاقية الاشتراك هذه أو أي من شروط استخدام موقعنا. يجوز لنا أيضًا إلغاء اشتراكك إذا لم يتم الوفاء بالتكاليف المصرح بها على بطاقتك الائتمانية ، أو إذا لم تعد شركة BetterTrend.Net مصرح لها بشحن بطاقتك الائتمانية. عند الإلغاء ، سيتم حرمانك من الوصول إلى الجزء المقيد / للأعضاء فقط من موقع BetterTrend.Net على الويب. لن تكون شركة BetterTrend.Net ملزمة بإعادة أي جزء من رسوم العضوية و / أو الاشتراك التي دفعتها قبل
                  </p>
                  <h3>مدة اتفاقنا</h3>
                  <p>
                      من خلال استكمال نموذج الاشتراك ، فإنك تفوض BetterTrend.Net بشحن بطاقتك الائتمانية مقابل رسوم العضوية المتكررة لمرة واحدة أو المتكررة نيابة عن BetterTrend.net
                     لا يوجد تاريخ انتهاء لعضويتك ، ولا تضمن BetterTrend.Net أي مدة زمنية محددة بأن هذه العضوية ستكون صالحة ، و / أو أن الموقع لا يزال قيد التشغيل.
                     تحتفظ BetterTrend.Net بالحق في إغلاق عمليات موقع الويب الخاص بها في أي وقت دون اللجوء إلى أعضائها الحاليين. 

                  </p>
                  <h3>ترخيص المستخدم المحدود الخاص بك</h3>
                  <p>
                     لا يُسمح لأي مشترك أو مستخدم آخر بنسخ أو بيع أو ترخيص أو تعديل أو توزيع أو إعادة إنتاج أو إرسال أو عرض علني أو تنفيذ علني أو نشر أو تكييف أو تعديل أو إنشاء أي من المواد أو محتوى الموقع على موقعنا على الويب أو أي أعمال مشتقة من أو استخدام محتوى الموقع، كليًا أو جزئيًا ، باستثناء ما هو مرخص به صراحةً بواسطة هذا الترخيص.
                  </p>
                  <h3>اتفاق السرية</h3>
                  <p>
                     المواد المتاحة لأعضاء BetterTrend.Net سرية ولا يجوز نسخها أو نقلها في أي وقت ، تحت أي ظرف من الظروف. يُمنع أعضاء BetterTrend.Net من مشاركة مواد الدورة التدريبية وأساليبنا وإشارات التجارة مع غير الأعضاء في BetterTrend.Net.
                  </p>
                  <h3>يحظر المنشورات والتعليق</h3>
                  <p>
                      أنت توافق على أنك سوف تمتنع عن أي تعليقات وتعليقات مسيئة أو تشهيرية أو بذيئة أو فاحشة أو سياسية أو عنصرية ، ولن تقوم بأي هجمات شخصية ، أو تستخدم أي لغة مسيئة أو غير لائقة ، وتنشر مواد ضارة بالقاصرين ، وتشترك في أي فرط أو العرض الأمامي أو وضع أو نشر أي "إعلانات غير مرغوب فيها" أو إعلانات أو مواد ترويجية على الموقع. تحتفظ BetterTrend.Net بالحق في رفض منح امتيازات النشر أو امتيازات الوصول الأخرى ، بما في ذلك على سبيل المثال لا الحصر إلغاء وإلغاء الاشتراك ، أو إنهاء العضوية ، بسبب انتهاك هذه الشروط.
                      قد تتحمل المسئولية عن أي محتوى غير قانوني أو محظور تقدمه إلى الموقع ، بما في ذلك ، من بين أمور أخرى ، غير قانوني أو فاحش أو تهديد أو تشهيري أو احترامي للخصوصية أو انتهاك حقوق الملكية الفكرية أو غيرها من المواد الضارة بأطراف ثالثة. يمكن أيضًا أن تتحمل مسؤولية المواد التي تتكون من أو تحتوي على فيروسات برامج أو حملات سياسية أو استدراج تجاري أو رسائل متسلسلة أو رسائل بريدية جماعية أو أي شكل من أشكال "البريد العشوائي". لا يجوز لك استخدام عنوان بريد إلكتروني مزيف أو انتحال شخصية أي شخص أو كيان أو التضليل فيما يتعلق بأصل المحتوى.
                      يحظر عليك استخدام اسم BetterTrend.Net دون موافقة كتابية مسبقة من المسؤول لدينا.
                      في غرفة التجارة و / أو غرفة الدردشة ، أنت توافق على الامتناع عن طرح أي وجميع الأسئلة التجارية أو الشخصية مباشرة من BetterTrend.Net في أي وقت. ومع ذلك ، يمكنك توجيه هذه الأسئلة عن طريق البريد الإلكتروني إلى Support@BetterTrend.Net.
                  </p>
                  <h3>التزامكم بتعويضنا</h3>
                  <p>
                     أنت توافق على تعويض شركة BetterTrend.Net وموظفيها ومديريها وموظفيها ووكلائها وشركائها ومقدمي المعلومات والموردين من ضد جميع المطالبات وأسباب الدعوى والدعاوى والخسائر والنفقات والأضرار والتكاليف ، بما في ذلك المعقول أتعاب المحاماة ، الناشئة عن ، فيما يتعلق أو فيما يتعلق بأي انتهاك من جانبك لاتفاقية الاشتراك أو شروط الاستخدام هذه ، بما في ذلك دعاوى انتهاك الملكية الفكرية أو حقوق الطرف الثالث ، أو غير ذلك ، الناتجة بشكل مباشر أو غير مباشر عن أو يمكن عزوها بأي طريقة للوصول إلى المواد أو المحتوى أو استخدامها أو نشرها على موقع الويب BetterTrend.Net بواسطتك.
                  </p>
                  <h3>الوصول والتدخل</h3>
                  <p>
                     أنت توافق على أنك لن تستخدم أي روبوت أو عنكبوت أو أي جهاز أوتوماتيكي آخر أو عملية يدوية لمراقبة أو نسخ صفحات الويب الخاصة بنا أو المحتوى الوارد فيها أو لأي غرض آخر غير مصرح به دون الحصول على إذن كتابي صريح ومسبق. أنت توافق على أنك لن تستخدم أي جهاز أو برنامج أو روتين للتدخل أو محاولة التدخل في العمل السليم لموقع الويب. أنت توافق على أنك لن تتخذ أي إجراء يفرض عبئًا كبيرًا غير معقول أو غير متناسب على بنيتنا التحتية. علاوة على ذلك ، فإنك توافق على عدم الانخراط في أي تأطير غير مرخص به أو ربطه أو ربطه بموقع الويب دون موافقة خطية مسبقة من BetterTrend.Net.
                  </p>
                  <h3>
                     شروط وأحكام أخرى
                  </h3>
                  <p>تشكل اتفاقية الاشتراك وشروط الاستخدام هذه معًا اتفاقية إضافية بينك وبين BetterTrend.Net وستظل الاتفاقية السابقة المبرمة بينك وبين BetterTrend.Net سارية.
                     اتفاقية الاشتراك والترخيص المحدود الممنوح لك شخصي ، ولا يجوز التنازل عنك أو نقلهما إلى أي شخص آخر. أنت توافق أيضًا على أنك لن تسمح لأي شخص آخر بالوصول إلى منطقة BetterTrend.Net للأعضاء فقط ما لم يكن هذا الشخص الآخر قد سجل كمشترك. أنت توافق على أنك مسؤول بمفردك عن أي مسؤولية تنشأ عن وصول أي طرف ثالث إلى الموقع الذي تسمح به أو تيسره. أنت توافق على أنك ستفقد عضويتك في الدورة التدريبية وكل الوصول إلى مواد الدورة التدريبية إذا تم منحها لغير الأعضاء من أي نوع ، ولا توجد أية مبالغ مستردة مقابل رسوم التسجيل إذا حدث ذلك. جميع المواد للأعضاء فقط.
                     تخضع هذه الاتفاقية وتفسر وفقًا للقانون السعودي. أنت توافق على أن استخدامك لـ BetterTrend.Net يشكل نشاطًا في المملكة العربية السعودية ولغرض التقاضي بشأن أي نزاع ينشأ بموجب هذه الاتفاقية ، فإنك توافق على أن أي إجراء قد بدأ ضد BetterTrend. مسألة الاختصاص داخل المملكة العربية السعودية. أنت توافق أيضًا على تقديم والموافقة على الاختصاص الشخصي ومكان أي من هذه المحاكم في حالة قيام BetterTrend.Net برفع دعوى ضدك.
                     إذا وجدت محكمة مختصة أخيرًا أن أي شرط أو شرط من اتفاقية الاشتراك أو شروط الاستخدام هذه باطل أو باطل أو غير قابل للتنفيذ أو مخالف للقانون بأي شكل آخر ، فإن ما تبقى من اتفاقية الاشتراك أو شروط الاستخدام ، مثل قد تكون هذه الحالة سارية المفعول بدون هذا المصطلح أو الحكم.
                     أي إخفاق من قبل BetterTrend.Net في فرض الأداء الصارم لأي حكم من شروط الاشتراك أو شروط الاستخدام لن يشكل تنازلاً عن حقها فيما بعد في تطبيق هذا الحكم أو أي شرط آخر من اتفاقية الاشتراك أو شروط الاستخدام.</p>
                  <h3>كيف تصبح مشترك</h3>
                  <p>
                      لتصبح مشتركًا ، يجب أن يكون عمرك 18 عامًا على الأقل وسيتعين عليك إكمال نموذج الاشتراك. إذا قمت بالتسجيل ، فستتم مطالبتك بدفع رسوم عضوية لمرة واحدة أو متكررة وستصدر بعض الوعود والاتفاقيات وستكون ملزمًا قانونًا بمراعاة شروط وأحكام اتفاقية الاشتراك الخاصة بنا وشروط استخدام BetterTrend. صافي موقع على شبكة الإنترنت ، والتي تتبع. يرجى قراءتها قبل ملء نموذج التسجيل.
                      يرجى العلم أنك كمشترك تقوم بشراء الوصول إلى موادنا التعليمية عبر الإنترنت. أنت تشتري الوصول إلى المعلومات والتعليم والتدريب لتصبح تاجرًا محترفًا. أنت لا تشتري البرمجيات ، وليس هناك ما يضمن أنك ستجني دخلاً. يتم منح جميع المشتركين حق الوصول إلى صفحات الويب ومقاطع الفيديو والملفات القابلة للتنزيل ضمن مواد الدورات التدريبية لموقعنا على الويب. سيستخدم المشتركون هذه المواد لمعرفة كيفية التداول كمحترف على مسؤوليتهم الخاصة.
                      باعتبارك مشتركًا ، فأنت توافق على أنك تدرك تمامًا ما تشتريه.
                  </p>
                  <h3>الاهتمام في الأوراق المالية أو السلع</h3>
                  <p>
                     من وقت لآخر ، قد يتخذ مشرفو BetterTrend.Net مراكز و / أو شراء أو بيع أوراق مالية أو سلع موضحة في غرفة التجارة.
                  </p>
                  <h3>طريقة التوصيل</h3>
                  <p>
                     تتوفر جميع مواد الدورات التدريبية عبر الإنترنت كمزيج من صفحات الويب المحمية والمستندات القابلة للتنزيل ومقاطع الفيديو عبر الإنترنت. العضوية المتقدمة هي دفعة لمرة واحدة ؛ لا توجد رسوم شهرية أو متكررة ، إلا إذا اخترت القيام بخطة دفع.
                  </p>
                  <h3>سياسة الخصوصية</h3>
                  <p>
                      تقوم شركة BetterTrend.Net بجمع معلومات شخصية عن عملائنا من خلال تسجيل الرسائل الإخبارية بالبريد الإلكتروني وتسجيل عضويتنا. نجمع اسمك وعنوان بريدك الإلكتروني فقط إذا كنت مشتركًا في الرسائل الإخبارية فقط. عندما تقوم بالتسجيل للحصول على عضوية ، ستكون هناك حاجة إلى اسمك وعنوانك ومعلومات بطاقة الائتمان الخاصة بك لمعالجة بطاقتك الائتمانية ، ويتم الاحتفاظ بهذه المعلومات بشكل آمن خارج الموقع من قبل جهة خارجية خاضعة للتنظيم لضمان أن معلوماتك الشخصية آمنة ومأمونة ، و هناك حاجة إلى المعلومات الضرورية فقط لمعالجة المعاملة ، ولا يتم بيعها أو مشاركتها مع أي شخص آخر لأي سبب من الأسباب.
                      تقوم BetterTrend.Net بإنشاء سجل لنشاط كل عضو عندما يكون داخل قسم الأعضاء فقط في موقع الويب. يتم تسجيل عنوان IP الفريد الخاص بك والبريد الإلكتروني وكلمة المرور عند التسجيل ، ويتم حفظه في ملف على خوادمنا. يرجى العلم أنه في كل مرة تقوم فيها بتسجيل الدخول إلى قسم عضويتك في موقع الويب الخاص بك ، يتم تتبع عنوان IP الخاص بك ، إلى جانب نشاطك على موقعنا.
                      من وقت لآخر ، سوف ترسل BetterTrend.Net رسائل بريد إلكتروني إلى أعضائها المسجلين. من خلال التسجيل للحصول على قوائم المراسلات لدينا ، أو التسجيل كعضو في BetterTrend.Net فإنك تسمح لنا بإرسال بريد إليكتروني وهاتف ومراسلات Skype. يمكنك في أي وقت التوقف عن تلقي رسائل البريد الإلكتروني هذه عن طريق اختيار "إلغاء الاشتراك" إما في البريد الإلكتروني نفسه أو ضمن إعدادات الحساب ، أو بكتابة بريد إلكتروني إلينا يطلب إزالته: Support@BetterTrend.Net
                      لا تقوم BetterTrend.Net ببيع أو مشاركة قائمة البريد الإلكتروني الخاصة بها مع أي شركة أو مواقع ويب أخرى. تأخذ BetterTrend.Net خصوصيتك الشخصية على محمل الجد ولا تشارك معلوماتك ، العامة أو الخاصة مع أي شخص آخر.
                      لأسباب قانونية ، قد يُطلب منا الإفصاح عن معلومات معينة للامتثال للقانون أو التحقيق أو الإجراءات القانونية ، مثل أمر من المحكمة أو أمر استدعاء ، وسنخطرك قبل إصدار هذه المعلومات ، إذا سمح القانون بذلك.
                  </p>
                  <h3>الكشف والتصريح عن اتصال المواد</h3>
                  <p> 
                     يجب أن تفترض أن صاحب هذا الموقع لديه علاقة تابعة و / أو أي اتصال مادي آخر ، إلى أي من موردي السلع والخدمات التي قد تتم مناقشتها هنا ، وقد يتم تعويضهم عن عرض الإعلانات أو التوصية بالمنتجات أو الخدمات ، أو الارتباط بـ موقع المورد</p>
                  <h3>معلومات الشركة</h3>
                  <p>
                      الشركة الأم لـ BetterTrend.Net هي شركة الاتجاه الأفضل.
                      سيتم إجراء جميع المدفوعات لشركة الاتجاه الأفضل وسيظهر بيان بطاقة الائتمان الخاص بك على أنه مدفوع لشركة الاتجاه الأفضل. جميع المبالغ المعروضة على موقع الويب هي بالريال السعودي ، وجميع المبالغ المدفوعة بالريال السعودي أو الدولار الأمريكي إذا تم ذكرها.
                  </p>
                  <h3>معلومات الاتصال:</h3>
                  <p>
                     شركة الاتجاه الأفضل
                     الرياض، الرمز البريدي
                     رقم الاتصال: xxx.xxxx.xxxx
                     أوقات العمل (............... )
                     Support@BetterTrend.Net
                  </p>
                  <h3>
                     سياسة الاسترجاع والتبديل: جميع المبيعات نهائية
                  </h3>
                  <p>
                     - لا يحق للعميل الحصول على أي استرجاع للمبلغ على الإطلاق، سواء تم استخدام المنتج أو لم يتم، إلا في حالة النشاطات التدريبية والتي تم شرحها أدناه.
                     - للعميل الحق في استبدال المنتج في حال تم ايصاله في حالة تالفة أو في حالة لا يمكن بها استخدامه خلال 3 أيام من تاريخ شحن المنتج للعميل، ينبغي على العميل إبلاغنا برغبة الاسترجاع خلال هذه الفترة.
                     - في حال الاشتراك في النشاطات التدريبية، والرغبة في الانسحاب قبل 24 ساعة من تاريخ بداية النشاط، فإن رسوم الدورة تبقى كرصيد للعميل يمكن استخدامه في دورات أخرى أو خصم 50% من قيمة الرسوم للاسترداد.
                     - جميع المواد الموجودة على الموقع وفي المواد الدراسية محمية بموجب قوانين حقوق النشر ، سوف تقوم BetterTrend.Net وشركتها الأم بمتابعة انتهاك حقوق الطبع والنشر إلى أقصى حدود القانون.
                  </p>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- end main-content -->
@stop