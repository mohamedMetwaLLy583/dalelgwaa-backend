<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'description_one_ar' => 'مكتب دليل الجواء العقاري متخصص في تقديم خدمات تسويق ووساطة عقارية بمنطقة القصيم. نعمل على تسهيل بيع وتأجير العقارات من خلال خبرة طويلة واحترافية عالية، مع التركيز على الشفافية والجودة لتلبية احتياجات عملائنا. فريقنا يضم نخبة من الخبراء في السوق العقاري، يعملون بتفانٍ لتقديم استشارات مخصصة وحلول مبتكرة. بالإضافة إلى ذلك، نوفر خدمات تصوير احترافي وتصميم مواد تسويقية تبرز جمال العقار وتزيد من فرص بيعه أو تأجيره. رؤيتنا هي أن نكون الخيار الأول في القطاع العقاري من خلال بناء علاقات قائمة على الثقة وتحقيق تطلعات عملائنا بأعلى المعايير. نحن نؤمن بأهمية التعامل الشخصي مع كل عميل، لضمان تقديم خدمة تتناسب مع احتياجاته الخاصة، سواء كان يبحث عن منزل أحلامه أو استثمار عقاري مربح',
            'description_one_en' => 'Dalil Aljawaa Real Estate Office specializes in providing real estate marketing and brokerage services in the Qassim region. We work to facilitate the sale and rental of real estate through long experience and high professionalism, focusing on transparency and quality to meet the needs of our customers. Our team includes a group of experts in the real estate market, working diligently to provide customized consultations and innovative solutions. In addition, we provide professional photography services and design marketing materials that highlight the beauty of the property and increase its chances of being sold or rented. Our vision is to be the first choice in the real estate sector by building relationships based on trust and achieving our clients\' aspirations to the highest standards. We believe in the importance of personal interaction with each client to ensure that we provide a service that meets their specific needs, whether they are looking for their dream home or a profitable real estate investment.',
            'description_two_ar' =>'رسالتنا هي أن نقدم خدمات تسويقية ووساطة عقارية تتميز بالشفافية، الجودة، والاحترافية، بما يعكس التزامنا الكامل بتلبية احتياجات عملائنا. نحن نؤمن بأن العقار ليس مجرد مبنى، بل هو استثمار لمستقبل عملائنا. لذلك، نقدم حلولاً عقارية مبتكرة ومرنة، مدعومة بفريق من الخبراء المتخصصين في السوق العقاري، مما يساهم في تسهيل كل عملية عقارية مع ضمان حصول العميل على أفضل العروض والفرص. رسالتنا هي تحقيق رضا العميل بأعلى مستويات الخدمة والكفاءة',
            'description_two_en' => 'Our mission is to provide real estate marketing and brokerage services that are characterized by transparency, quality, and professionalism, reflecting our full commitment to meeting the needs of our customers. We believe that real estate is not just a building, but an investment in the future of our clients. Therefore, we offer innovative and flexible real estate solutions, supported by a team of experts specializing in the real estate market, which contributes to facilitating every real estate transaction while ensuring that the client gets the best offers and opportunities. Our mission is to achieve customer satisfaction at the highest levels of service and efficiency',
            'description_three_ar' => 'نحن في مكتب دليل الجواء العقاري نطمح لأن نكون الرائدين في قطاع العقارات في منطقة القصيم، وأن نقدم حلولًا عقارية متكاملة ومتطورة للعملاء، مع التركيز على توفير فرص استثمارية مميزة. نسعى لبناء علاقات طويلة الأمد مع عملائنا من خلال تقديم خدمات عالية الجودة، ونسعى دائمًا إلى تحسين وتحقيق تطلعاتهم. رؤيتنا هي أن نكون الخيار الأول للعملاء الباحثين عن الاستشارات العقارية الموثوقة والحلول المتقدمة، مما يجعلنا الشريك المثالي لهم في عالم العقارات',
            'description_three_en' => 'At Dalil Aljawaa Real Estate Office, we aspire to be leaders in the real estate sector in the Qassim region, and to provide integrated and advanced real estate solutions to customers, focusing on providing distinctive investment opportunities. We seek to build long-term relationships with our customers by providing high-quality services, and we always strive to improve and achieve their aspirations. Our vision is to be the first choice for customers looking for reliable real estate consultations and advanced solutions, making us the ideal partner for them in the world of real estate',
        ]);
    }
}
