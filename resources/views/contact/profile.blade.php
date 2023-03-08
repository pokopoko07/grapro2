<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Profile
        </h2>

    </x-slot>
    <div class="container_profile_1 m-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        {{-- 左側 --}}
        <div class="prof_itemL bg-teal-50">
            <img src="{{ asset('logo/profile.jpg')}}" class="m-8 mx-auto w-1/2 rounded-full">
            <div class="text-left flex justify-center">
                <table>
                    <tr>
                        <th valign="top">名前：</th><td>pokoMom.T</td>
                    </tr>
                    <tr>
                        <th valign="top">出身：</th><td>香川県</td>
                    </tr>
                    <tr>
                        <th valign="top">趣味：</th><td>絵を描くこと・見ること<br>モノづくり<br>ギター始めました</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex justify-center">
                                <div class="bg-green-500 text-white rounded-md w-1/2 text-center drop-shadow-lg hover:bg-sky-700">
                                    <a href="https://github.com/pokopoko07/grapro2" target="_blank" rel="noopener noreferrer">GitHub:公開コード</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="flex justify-center">
                                <div class="bg-blue-500 text-white rounded-md w-1/2 text-center drop-shadow-lg hover:bg-sky-700">
                                    <a href="{{ route('contact.create') }}" class="{{ request()->routeIs('contact.create') ? 'active' : '' }}">
                                        お問い合わせ
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        {{-- 右側 --}}
        <div class="prof_itemR md:col-span-2">
            <div class="container_profile_2 grid grid-cols-3 grid-rows-3 gap-8">
                <div class="bg-teal-50"></div>
                <div class="col-span-2 bg-white rounded-2xl">
                    <div class="m-4">
                        <span class="font-semibold">プログラマー、SEを目指した理由--</span>
                        　小学3年生の時、お年玉を貯めて買ったMSXというキーボード型のパソコンで、初めてプログラミング
                        に触れました。学研の科学という雑誌に書いてあったプログラムを、意味もわからず、ただ打ちこみま
                        した。「壁打ちテニスのゲーム」プログラムだったと思います。一文字一文字間違えないように、
                        何度もやり直しながら丁寧に打った覚えがあります。<br>
                        　それが、正しく動いたとき、言い知れない感動と興奮がありました。その時の気持ちが忘れられず、
                        SE、プログラマーのになろうと決意しました。
                    </div>
                </div>
                <div class="col-span-2 bg-white rounded-2xl">
                    <div class="m-4">
                        <span class="font-semibold">経歴--</span>
                        　大学で情報工学を学んだ後、医療機器メーカーでシステムエンジニアとして5年半、ユーザーインターフェース
                        の開発を行いました。使用した言語は、C言語、C++でした。しかし、月平均130時間を超える残業時間に、とても、
                        育児をしながら働くのは難しいと考え、結婚後、しばらくして、プログラマーをあきらめてしまいました。<br>
                        　その後、医療事務員としてクリニックや総合病院にて、算定業務にあたっていました。40代になり、
                        本当にやりたいことはなんだろうと人生を考えたとき、MSXで打ったプログラムが正しく動いた感動を思い出し、
                        もう一度、プログラマーの勉強をしようと、一念発起して職業訓練校の「プログラミング習得科」で、WEB
                        プログラムを勉強し直しました。
                    </div>
                </div>
                <div class="bg-teal-50"></div>
                <div class="bg-teal-50"></div>
                <div class="col-span-2 bg-white rounded-2xl">
                    <div class="m-4">
                        <span class="font-semibold">スキル--</span>
                        　職業訓練校では、「HTML」、「css」、「PHP」、「JavaScript」、「mySQL」、「Laravel」を学びました。20年
                        以上前の経験が生かせるか不安でしたが、授業が進むうちに、プログラムを組む感覚が戻ってきました。自分の中に、
                        ちゃんとプログラミング技術が残っていることを確信できました。<br>
                        　半年だけの学生生活でしたが、本当に勉強に打ち込みました。濃密な半年間を過ごせたと思います。
                        職業訓練で習ったことは、WEB開発に関わることばかりでしたが、プログラミングに関われるのであれば、新しい言語
                        や技術を勉強していくつもりです。初心に戻って検挙に、そして、臆することなく、新しいことに挑戦したいです。
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>