<x-guest-layout>
    <body class="antialiased">
        <div class="h-screen pb-2 bg-right bg-cover">
            <div class="container pt-2 md:pt-18 px-6 mx-auto flex flex-col md:flex-row items-center bg-white-100">
                
                {{-- 左側 --}}
                @php
                     // public/imagesディレクトリ内のファイル一覧を取得する
                    $files = \File::files(public_path('storage/images'));

                    // 取得したファイル一覧から、JPEGファイルだけをフィルタリングする
                    $jpeg_files = [];
                    foreach ($files as $file) {
                        if (in_array($file->getExtension(), ['jpg', 'jpeg', 'JPG','JPEG'], true)) {
                            $jpeg_files[] = $file->getFilename();
                        }
                    }
                @endphp
                <div class="container_welcome w-full xl:w-3/5 py-6 overflow-y-hidden">
                    <div class="item_w1 h-32 w-full"> 
                        <img class="rounded-lg h-full w-full object-contain lg:mr-0" src="{{asset('logo/welcome.jpg')}}">
                    </div>
                    <div class="item_w2 w-full">
                        <img id="slideshow" class="rounded-lg h-full w-full object-cover lg:mr-0" src="{{asset('logo/takaitakai.jpg')}}">
                    </div>
                    <div class="item_w3 h-32 w-full">
                        <img id="slideshow3" class="rounded-lg h-full w-full object-cover lg:mr-0" src="{{asset('logo/girl.jpg')}}">
                    </div>
                    <div class="item_w4 h-32 w-full">
                        <img id="slideshow4" class="rounded-lg h-full w-full object-cover lg:mr-0" src="{{asset('logo/girl2.jpg')}}">
                    </div>
                    <div class="item_w5 h-32 w-full">
                        <img class="rounded-lg h-full w-full object-contain lg:mr-0" src="{{asset('logo/tree.jpg')}}">
                    </div>
                    <div class="item_w6 h-32 w-full">
                        <img id="slideshow6" class="rounded-lg h-full w-full object-cover lg:mr-0" src="{{asset('logo/tetunagi.jpg')}}">
                    </div>
                </div>
                <!--右側-->
                <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ">
                    <h1 class="my-4 mx-8 text-4xl md:text-8xl text-black-800 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">
                        <table>
                            <tr><td>アラ<br>カシ</td>
                                <td><img class="rounded-lg h-full w-full object-contain lg:mr-0" src="{{asset('logo/kashiwanoha.jpg')}}"></td>
                            </tr>
                        </table>
                        <h3 class="my-2 mx-8 text-2xl md:text-4xl text-green-800 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">
                            around Kashiwa.
                        </h3>
                    </h1>
                    <p class="mx-8 leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
                    　「アラカシ」　柏周辺=around Kashiwa　略して「アラカシ」です。柏周辺の、子供と一緒にお出かけできるお出かけスポットを紹介しています。
                    <br>
                    　ぜひ、お気軽にご利用ください。
                    </p>
        
                    <div class="flex w-full justify-center md:justify-center pb-24 lg:pb-0 fade-in">
                        {{-- ボタン設定 --}}
                        <a href="{{route('login')}}">
                            <x-primary-button class="mr-4 bg-green-600 font-bold text-base text-center">
                                ログインはこちら
                            </x-primary-button>
                        </a>
                        <a href="{{route('register')}}">
                            <x-primary-button class="mr-4 bg-red-600 font-bold text-base text-center">
                                ご登録はこちら
                            </x-primary-button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center">
                <div class="w-full md:text-left fade-in border-2 p-4  leading-8 mb-8">
                    <h1 class="text-black-800 text-center text-2xl md:text-4xl font-bold text-green-700">＜　本サイトの利用方法　＞</h1>
                    <div class="flex flex-col">
                    <div class="flex flex-col md:flex-row">
                        <div class="bg-blue-50 m-2 md:basis-1/2">
                            <div class="m-4 font-bold md:text-xl">
                                １．ユーザ登録もしくはログイン
                            </div>
                            <div class="m-4">
                                <a href="{{ asset('logo/setumei1.jpg')}}"  data-lightbox="group">
                                    <img src="{{ asset('logo/setumei1.jpg')}}" class="mx-auto fit_grid rounded-lg">
                                </a>
                            </div>
                            <div  class="m-4">
                                (a) 初めての方は、ユーザ登録をお願いします。<br>
                                (b) 2回目以降の方は、loginしてください。
                            </div>
                        </div>
                        <div class="bg-blue-50 m-2 md:basis-1/2">
                            <div class="m-4 font-bold md:text-xl">
                                ２．条件を選択して検索
                            </div>
                            <div class="m-4">
                                <a href="{{ asset('logo/setumei2.jpg')}}"  data-lightbox="group">
                                    <img src="{{ asset('logo/setumei2.jpg')}}" class="mx-auto fit_grid rounded-lg">
                                </a>
                            </div>
                            <div class="m-4">
                                ①単語による検索をします。複数入力も可能です。例）フワフワドーム　遊具<br>
                                ③施設区分によって検索します。<br>
                                ③場所によって検索します。<br>
                                ④犬連れOKかで検索します。<br>
                                ⑤お勧めの年代で検索します。☆が３つ以上の施設を検索します。<br>
                                ⑥検索ボタンを押してください。<br>
                                (何も指定しないで、検索画面を押すと全件表示されます。)
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row">
                        <div class="bg-blue-50 m-2 md:basis-1/2">
                            <div class="m-4 font-bold md:text-xl">
                                ３．一覧画面の施設名をクリック
                            </div>
                            <div class="m-4">
                                <a href="{{ asset('logo/setumei3.jpg')}}"  data-lightbox="group">
                                    <img src="{{ asset('logo/setumei3.jpg')}}" class="mx-auto fit_grid rounded-lg">
                                </a>
                            </div>
                            <div  class="m-4">
                                検索一覧が表示されます。気になる施設があれば、施設名か、「read more」をクリックしてください。より詳細な情報が得られます。
                            </div>
                        </div>
                        <div class="bg-blue-50 m-2 md:basis-1/2">
                            <div class="m-4 font-bold md:text-xl">
                                ４．詳細画面が表示されます。コメントもお気軽にどうぞ。
                            </div>
                            <div class="m-4">
                                <a href="{{ asset('logo/setumei4.jpg')}}"  data-lightbox="group">
                                    <img src="{{ asset('logo/setumei4.jpg')}}" class="mx-auto fit_grid rounded-lg">
                                </a>
                            </div>
                            <div  class="m-4">
                                追加したい情報があれば、コメント欄をご利用ください。写真も投稿できます。
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!--フッタ-->
                <div class="w-full pt-10 pb-6 text-sm md:text-left fade-in">
                    <p class="text-gray-500 text-center">@2023 アラカシ</p>
                </div>
            </div>
        </div>
        <script>
            let images = {!! json_encode($jpeg_files) !!};
            let index = 0;
            
            setInterval(function() {
                let index = Math.floor( Math.random() * images.length);
                // 画像を順次表示する
                // index = (index + 1) % images.length;
                let url = "{{ asset('storage/images') }}/" + images[index];
                document.getElementById('slideshow').src = url;
            }, 3000);

            setInterval(function() {
                let index = Math.floor( Math.random() * images.length);
                // 画像を順次表示する
                // index = (index + 1) % images.length;
                let url = "{{ asset('storage/images') }}/" + images[index];
                document.getElementById('slideshow3').src = url;

                let index4=0;
                do{
                    index4 = Math.floor( Math.random() * images.length);
                }while(index == index4);
                let url4 = "{{ asset('storage/images') }}/" + images[index4];
                document.getElementById('slideshow4').src = url4;

                let index6=0;
                do{
                    index6 = Math.floor( Math.random() * images.length);
                }while(index == index6 || index4 == index6);
                let url6 = "{{ asset('storage/images') }}/" + images[index6];
                document.getElementById('slideshow6').src = url6;

            }, 2000);


        </script>
    </body>
</x-guest-layout>
