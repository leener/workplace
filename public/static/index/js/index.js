jQuery(document).ready(function($) {
    function clicktabs(tit_id,box_id,cur){
        var g_tags=$(tit_id),
            g_conts=$(box_id),
            g_current=cur;
        g_tags.mouseover(function(){
            var g_index=g_tags.index(this);
            $(this).addClass(g_current).siblings().removeClass(g_current);
            g_conts.eq(g_index).show().siblings().hide();
        })
    }
    clicktabs("#labels_id li","#labels_con>div","current");

    $(".index_news:nth-child(2n)").css("margin-left","12px");
    $(".index_news:nth-child(3n)").css("float","right");

    $(".index_nav li a").click(function(){
        var index=this.title
        var id='#'+'item'+index
        $(this).parent().addClass('cur');
        $(this).parent().siblings().removeClass('cur');
        $("html,body").animate({scrollTop: $(id).offset().top}, 1000);
    });
    $('.gotop').click(function(){
        $('body,html').animate({
                scrollTop:0
            },
            1000);
    });
    $('.gotop').hide();
    $(function(){
        $(window).scroll(function(){
            var sTop = $(window).scrollTop();
            if(sTop > 400){
                $(".gotop").fadeIn(1000);
            }else{
                $(".gotop").fadeOut(1000);
            }
        })
    });
});
//移动手机跳转
var murl = location.href;
murl = murl.replace('www.cnwaji.com/','m.cnwaji.com/');

function is_mobile() {
    var regex_match = /(nokia|iphone|android|motorola|^mot-|softbank|foma|docomo|kddi|up.browser|up.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte-|longcos|pantech|gionee|^sie-|portalmmm|jigs browser|hiptop|^benq|haier|^lct|operas*mobi|opera*mini|320x320|240x320|176x220)/i;
    var u = navigator.userAgent;
    var result = regex_match.exec(u);
    if (null == result) {
        return false
    } else {
        return true
    }
}
if (is_mobile()) {
    window.location.href=murl;
}