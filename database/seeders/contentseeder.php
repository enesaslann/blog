<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class contentseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('content')->insert([
            [
                'category_id' => 1,
                'title' => 'Başlık',
                'image' => 'https://picsum.photos/id/237/750/300',
                'content' => "<div class='content-body__description'>Avrupa Uzay Ajansı (ESA), D&uuml;nya'nın uydusu Ay'da inşa edilecek olan evlerin nasıl g&ouml;r&uuml;neceğini g&ouml;steren yeni g&ouml;rseller paylaştı. ESA Danışmanı Aidan Cowley, evlerin inşasına 10 yıl i&ccedil;erisinde başlanabileceğini s&ouml;yl&uuml;yor.</div>
                <div class='inread-tagon'>&nbsp;</div>
                <div class='content-body__detail'>
                <p>2024 yılına kadar Ay'a bir kadın ve bir erkek astronot g&ouml;ndermeyi planlayan&nbsp;<span>Amerikan Ulusal Havacılık ve Uzay Dairesi (NASA),&nbsp;</span>9 Aralık tarihinde Artemis adlı uzay g&ouml;revine uygun g&ouml;rd&uuml;ğ&uuml; 18 astronotun adını a&ccedil;ıklamıştı. &nbsp;S&ouml;z konusu g&ouml;revin bir kısmı, uydumuzda&nbsp;<span>s&uuml;rd&uuml;r&uuml;lebilir bir</span>&nbsp;<span>koloni</span>&nbsp;inşa etmeyi de i&ccedil;eriyor.</p>
                <p>G&ouml;rev kapsamında kolonideki m&uuml;hendislerin ise kraterlerdeki buzdan su &uuml;retmek gibi Ay'daki kaynakları nasıl kullanacağını &ouml;ğrenebilmesi planlanıyor ve bu sebeple Ay'da astronotların yaşayabileceği evlerin inşa edilmesi gerekiyor. Şimdiyse Avrupa Uzay Ajansı (ESA)&nbsp;<span>Ay'da inşa edilecek evleri</span>&nbsp;g&ouml;rselleriyle tanıttı.</p>
                <h2>Ay evleri nasıl g&ouml;r&uuml;necek?</h2>
                
                <p>ESA'nın paylaştığı g&ouml;r&uuml;nt&uuml;ler, Ay'da yaşayacak ilk astronotların evlerinin nasıl g&ouml;r&uuml;nebileceğini ortaya koyuyor. Uzay ajansında danışmanlık yapan Aidan Cowley, bu yapıların zor şartlara&nbsp;<span>Ay toprağından yapılma tuğlayla</span>&nbsp;karşı koyabileceğini s&ouml;yledi.</p>
                <p>Ay g&ouml;revleri kapsamında ilk astronotların, Ay'ın daha &ouml;nce keşfedilmemiş alanlarını incelemesi ve başka astronotların da&nbsp;<span>Mars'a gidebilecekleri</span>&nbsp;bir &uuml;s sağlaması hedefleniyor zira NASA, buraya 2030'lara kadar bir kadın ve erkek daha g&ouml;ndermeyi istiyor.</p>
                <p>Bunun olup olmayacağının artık sorulmaması gerektiğini belirten Cowley,&nbsp;<em>'Bu ger&ccedil;ekleşmeli. &Ccedil;&uuml;nk&uuml; eğer&nbsp;<span>Ay, Mars veya bunların &ouml;tesinde</span>&nbsp;herhangi bir yerin keşfi konusunda ciddiysek, bu &ccedil;ok yakında ustalaşmamız gereken bir teknoloji'</em>&nbsp;şeklinde konuştu.</p>
                <h2>Yapıların 10 yıl i&ccedil;erisinde inşa edilmeye başlanacağı s&ouml;yleniyor:</h2>
                <
                <p>Aktarılanlara g&ouml;re Cowley, astronotların yaşayabileceği silindir şeklindeki yapıların 10 yıl i&ccedil;inde inşa edilmeye başlanacağına inansa da bu yapıların&nbsp;<span>radyasyona</span>&nbsp;maruz kalmaya karşı korunması gerekiyor. Bu noktada Cowley, ESA'nın koruyucu tuğlalar elde etmek i&ccedil;in pudra şekeri kadar ince olan ve regolit adıyla da bilinen&nbsp;<span>Ay toprağını kullanma</span>&nbsp;planlarına da &ouml;nc&uuml;l&uuml;k ediyor.</p>
                <p>Araştırmacılar, bir metre kalınlığındaki regolit duvarlar ve &ccedil;atının, inşa edilecek yapıları Ay'daki radyasyon ve donma tehlikesine karşı koruyacağını d&uuml;ş&uuml;n&uuml;yor. Planlara g&ouml;re robotların y&uuml;zeyin &uuml;st katmanından topladığı toprak, 3D yazıcılar tarafından&nbsp;<span>tuğlaya</span>&nbsp;<span>d&ouml;n&uuml;şt&uuml;r&uuml;lecek</span>&nbsp;ve g&uuml;neşte pişmeye bırakılacak.</p>
                </div>",
                'slug' => Str::slug("Başlık", "-"),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
