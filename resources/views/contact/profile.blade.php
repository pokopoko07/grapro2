<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Profile
        </h2>

    </x-slot>
    <div class="container_profile_1 m-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        {{-- 左側 --}}
        <div class="prof_itemL bg-teal-50">
            <img src="{{ asset('logo/profile.jpg')}}" class="m-8 mx-auto w-1/2 rounded-full">{{--"mx-auto fit_grid rounded-full"--}} 
            <ul class="text-center">
                <li>名前：Mihoko.T</li>
                <li></li>
                <li class="mt-4">
                    <div class="flex justify-center">
                        <div class="bg-green-500 text-white rounded-md w-1/2 text-center drop-shadow-lg hover:bg-sky-700">
                            <a href="https://github.com/pokopoko07">GitHub:公開コード</a>
                        </div>
                    </div>
                </li>
                <li></li>
                <li class="mt-4">
                    <div class="flex justify-center">
                        <div class="bg-blue-500 text-white rounded-md w-1/2 text-center drop-shadow-lg hover:bg-sky-700">
                            <a href="{{ route('contact.create') }}" class="{{ request()->routeIs('contact.create') ? 'active' : '' }}">
                                お問い合わせ
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        {{-- 右側 --}}
        <div class="prof_itemR md:col-span-2">
            <div class="container_profile_2 grid grid-cols-3 grid-rows-3 gap-8">
                <div class="bg-teal-50"></div>
                <div class="col-span-2 bg-white">
                    <div class="m-4">
                        　小学3年生の時、お年玉を貯めて買ったMSXというキーボード型のパソコンで、初めてプログラミング
                        に触れました。学研の科学という雑誌に書いてあったプログラムを、意味もわからず、ただ打ちこみま
                        した。「壁打ちテニスのゲーム」プログラムだったと思います。一文字一文字間違えないように、
                        何度もやり直しながら丁寧に打った覚えがあります。<br>
                        　それが、正しく動いたとき、言い知れない感動と興奮がありました。その時の気持ちが忘れられず、
                        SE、プログラマーのになろうと決意しました。
                    </div>
                </div>
                <div class="col-span-2 bg-white">
                    <div class="m-4">
                        　大学で情報工学を学んだ後、医療機器メーカーでシステムエンジニアとして5年半働きました。そのころは、
                        C言語、C++でプログラムを組んでいました。しかし、月平均130時間を超える残業時間に、とても、
                        育児をしながら働くのは無理と考え、結婚後、一度プログラマーをあきらめてしまいました。<br>
                        　その後、医療事務員としてクリニックや総合病院にて、算定業務にあたっていました。人生40代になり、
                        本当にやりたいことはなんだろうと考えたとき、MSXで打ったプログラムが正しく動いた感動を思い出し、
                        もう一度、プログラマーの勉強をしようと、一念発起して職業訓練校の「プログラミング習得科」で、WEB
                        プログラムを勉強し直しました。
                    </div>
                </div>
                <div class="bg-teal-50"></div>
                <div class="bg-teal-50"></div>
                <div class="col-span-2 bg-white">6</div>
            </div>
        </div>
    </div>

</x-app-layout>