<!--
    Version 1.0.2 2019/11/14
    * 使用方法 *
    將要使用插件的iframe加入class="youtube_plugin"後
    至script中的 pattems 陣列填入所需功能即可
    使用video class 可以做出基本RWD效果(可自行修改CSS套入)
    影片網址需設定在 data-src 屬性中
 -->
<style>
    .video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

<body>
    <div style="width: 100%;height: 50%;">
        <!-- 此為播放清單網址範例iframe -->
        <iframe data-src="https://www.youtube.com/watch?v=HK7SPnGSxLM&list=RDHK7SPnGSxLM&start_radio=1" frameborder="0" allowfullscreen class="youtube_plugin"></iframe>
    </div>
    <div style="width: 100%;height: 50%;">
        <!-- 此為範例iframe -->
        <iframe data-src="https://www.youtube.com/watch?v=0HTAKT-JIaA" frameborder="0" allowfullscreen class="youtube_plugin"></iframe>
    </div>
</body>

<!-- 此為jQuery -->
<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

<script type="text/javascript">
    jQuery.each($('iframe.youtube_plugin'), function(key, value) {
        /*
            * 初始化設定,請勿修改 *
            type1: 預設0,填入1
            type2: 預設1,填入0
        */
        setting_types = {
            'autoplay': 'type1',
            'mute': 'type1',
            'loop': 'type1',
            'controls': 'type2',
            'disablekb': 'type1',
            'fs': 'type2',
            'rel': 'type2',
        };
        /*
            * 需要的功能填入下方 pattems 陣列 *
            autoplay:自動撥放,必須與mute同時使用才能生效
            mute:靜音
            loop:自動重複播放
            controls:填入將不顯示控制列
            disablekb:填入將不受鍵盤操控
            fs:填入將不顯示全屏按鈕
            rel:影片結束時不跳出相關影片 [因Youtube API規範修改,不一定能生效,觸發條件未知]
        */
        pattems = [
            'autoplay',
            'mute',
            'loop',
        ];

        //取得目標網址
        url = $(this).attr('data-src').replace("watch?v=", "embed/").replace("&list", "?list");
        //將所需功能處理後加入網址
        jQuery.each(pattems, function(k, v) {
            url += (url.indexOf('?') < 0) ? '?' + v : '&' + v;
            switch(setting_types[v])
            {
                case 'type1':
                    url += '=1';
                    break;
                case 'type2':
                    url += '=0';
                    break;
            }
        });
        //替代新網址
        $(this).attr('src',url);
    });
</script>