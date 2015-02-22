/////////////////////////////////
//TOPへ戻るボタン
/////////////////////////////////
jQuery(function(){
  jQuery(window).scroll(function(){
    //最上部から現在位置までの距離を取得して、変数[now]に格納
    var now = jQuery(window).scrollTop();
    //最上部から現在位置までの距離(now)が600以上
    if(now > 600){
      //[#page-top]をゆっくりフェードインする
      jQuery('#page-top').fadeIn('slow');
      //それ以外だったらフェードアウトする
    }else{
      jQuery('#page-top').fadeOut('slow');
    }
    //console.log(wrapperTop);
  });
  //ボタン(id:move-page-top)のクリックイベント
  jQuery('#move-page-top').click(function(){
  //ページトップへ移動する
  jQuery('body,html').animate({
          scrollTop: 0
      }, 800);
  });
});

/////////////////////////////////
//スクロール追従
/////////////////////////////////
(function(jquery) {
//  var wrapperTop = 0;
//  //-------------------------------------------------
//  //非同期の読み込みでサイドバーの高さが変わるため
//  //スクロール追従エリア作動場所がずれるのを防ぐ処理
//  //※ここらへんの処理は重くはないはずだけど酷い
//  //（良い方法があったら教えてください）
//  function getWrapperTop() {
//    var side = jQuery('#sidebar-widget'); // サイドバーのID
//    wrapperTop = side.outerHeight();
//    console.log(wrapperTop);
//  }
//
//  //5秒後にもスクロール追従領域の高さを取得
//  setTimeout(function(){
//    getWrapperTop();
//  },5000);
//
//  //10秒後にもスクロール追従領域の高さを取得
//  setTimeout(function(){
//    getWrapperTop();
//  },10000);
//
//  //20秒後にもスクロール追従領域の高さを取得
//  setTimeout(function(){
//    getWrapperTop();
//  },20000);
//
//  //30秒後にもスクロール追従領域の高さを取得
//  setTimeout(function(){
//    getWrapperTop();
//  },30000);
//
//  //60秒後にもスクロール追従領域の高さを取得
//  setTimeout(function(){
//    getWrapperTop();
//  },60000);
//
//  //何もかも読み込んだ後のスクロール追従領域の高さを取得
//  jQuery(window).load(function(){
//    getWrapperTop();
//  })
//  //-------------------------------------------------

  jquery(document).ready(function() {
    /*
    Ads Sidewinder
    by Hamachiya2. http://d.hatena.ne.jp/Hamachiya2/20120820/adsense_sidewinder
    */
    var main = jQuery('#main'); // メインカラムのID
    var side = jQuery('#sidebar'); // サイドバーのID
    var wrapper = jQuery('#sidebar-scroll'); // スクロール追従要素のID
    var side_top_margin = 40;
    if (!wrapper.size()) {return;}//スクロール追従エリアにウイジェットが入っていないときはスルー
    if (side.css('clear') == 'both') {return;}//レスポンシブでサイドバーをページ下に表示しているときはスルー

    if (main.length === 0 || side.length === 0 || wrapper.length === 0) {
      return;
    }

    var w = jquery(window);
    var wrapperHeight = wrapper.outerHeight();
    wrapperTop = wrapper.offset().top;//とりあえずドキュメントを読み込んだ時点でスクロール追従領域の高さを取得
    var sideLeft = side.offset().left;
    //console.log(wrapperTop);

    var sideMargin = {
      top: side.css('margin-top') ? side.css('margin-top') : 0,
      right: side.css('margin-right') ? side.css('margin-right') : 0,
      bottom: side.css('margin-bottom') ? side.css('margin-bottom') : 0,
      left: side.css('margin-left') ? side.css('margin-left') : 0
    };

    var winLeft;
    var pos;

    var scrollAdjust = function() {
      sideHeight = side.outerHeight();
      mainHeight = main.outerHeight();
      mainAbs = main.offset().top + mainHeight;
      var winTop = w.scrollTop()+side_top_margin;
      winLeft = w.scrollLeft();
      var winHeight = w.height();
      var nf = (winTop > wrapperTop) && (mainHeight > sideHeight) ? true : false;
      pos = !nf ? 'static' : (winTop + wrapperHeight) > mainAbs ? 'absolute' : 'fixed';
      if (pos === 'fixed') {
        side.css({
          position: pos,
          top: '',
          bottom: winHeight - wrapperHeight,
          left: sideLeft - winLeft,
          margin: 0,
          marginBottom: '-'+side_top_margin+'px'
        });

      } else if (pos === 'absolute') {
        side.css({
          position: pos,
          top: mainAbs - sideHeight,
          bottom: '',
          left: sideLeft,
          margin: 0,
          marginBottom: '-'+side_top_margin+'px'
        });

      } else {
        side.css({
          position: pos,
          marginTop: sideMargin.top,
          marginRight: sideMargin.right,
          marginBottom: sideMargin.bottom,
          marginLeft: sideMargin.left
        });
      }
    };

    var resizeAdjust = function() {
      side.css({
        position:'static',
        marginTop: sideMargin.top,
        marginRight: sideMargin.right,
        marginBottom: sideMargin.bottom,
        marginLeft: sideMargin.left
      });
      sideLeft = side.offset().left;
      winLeft = w.scrollLeft();
      if (pos === 'fixed') {
        side.css({
          position: pos,
          left: sideLeft - winLeft,
          margin: 0,
          marginBottom: '-'+side_top_margin+'px'
        });

      } else if (pos === 'absolute') {
        side.css({
          position: pos,
          left: sideLeft,
          margin: 0,
          marginBottom: '-'+side_top_margin+'px'
        });
      }
    };
    w.on('load', scrollAdjust);
    w.on('scroll', scrollAdjust);
    w.on('resize', resizeAdjust);
  });
})(jQuery);

/////////////////////////////////
// メニューボタンの開閉
/////////////////////////////////
jQuery(document).ready(function() {
  jQuery('#mobile-menu-toggle').click(function(){
    header_menu = jQuery('#navi ul');
    if (header_menu.css('display') == 'none') {
      //header_menu.removeClass('display-hide').addClass('display-block');
      header_menu.slideDown();
    } else{
      //header_menu.removeClass('display-block').addClass('display-hide');
      header_menu.slideUp();
    };
  });

});

jQuery(function(){
  jQuery(window).scroll(function(){
    //console.log(jQuery('#sidebar').css('clear'));
    //最上部から現在位置までの距離を取得して、変数[now]に格納
    var now = jQuery(window).scrollTop();
    var sharebar = jQuery('#sharebar');
    if (!sharebar.size()) {return;}
    var main = jQuery('#main');
    var sharebar_top = sharebar.offset().top;
    var sharebar_h = sharebar.outerHeight();
    var main_top = main.offset().top;
    var main_h = main.outerHeight();

    var bottom_line = main_h-400;
    if(now < (main_h-sharebar_h)){
      if (now > main_top) {
        //sharebar.fadeIn('fast');
        sharebar.css({
          position: 'fixed',
          top: '70px'
        });
      } else{
        sharebar.css({
          position: 'absolute',
            top: main_top+70
        });
      };
    }else{
      //sharebar.fadeOut('fast');
      sharebar.css({
        position: 'absolute',
        top: main_h-sharebar_h
      });
    }
    //console.log(sharebar_h);

  });
});

// Twitterのシェア数を取得
function get_social_count_twitter(url, selcter) {
  jQuery.ajax({
  url:'http://urls.api.twitter.com/1/urls/count.json',
  dataType:'jsonp',
  data:{
    url:url
  },
  success:function(res){
    jQuery( selcter ).text( res.count || 0 );
  },
  error:function(){
    jQuery( selcter ).text('0');
  }
  });
}

//Facebookのシェア数を取得
function get_social_count_facebook(url, selcter) {
  jQuery.ajax({
    url:'https://graph.facebook.com/',
    dataType:'jsonp',
    data:{
      id:url
    },
    success:function(res){
      jQuery( selcter ).text( res.shares || 0 );
    },
    error:function(){
      jQuery( selcter ).text('0');
    }
  });
}

//Google＋のシェア数を取得
function get_social_count_googleplus(url, selcter) {
  jQuery.ajax({
    type: "get", dataType: "xml",
    url: "http://query.yahooapis.com/v1/public/yql",
    data: {
      q: "SELECT content FROM data.headers WHERE url='https://plusone.google.com/_/+1/fastbutton?hl=ja&url=" + url + "' and ua='#Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36'",
      format: "xml",
      env: "http://datatables.org/alltables.env"
    },
    success: function (data) {
      var content = jQuery(data).find("content").text();
      var match = content.match(/window\.__SSR[\s*]=[\s*]{c:[\s*](\d+)/i);
      var count = (match != null) ? match[1] : 0;

      jQuery( selcter ).text(count);
    }
  });
}

//はてなブックマークではてブ勝を取得
function get_social_count_hatebu(url, selcter) {
  jQuery.ajax({
    url:'http://api.b.st-hatena.com/entry.count?callback=?',
    dataType:'jsonp',
    data:{
      url:url
    },
    success:function(res){
      jQuery( selcter ).text( res || 0 );
    },
    error:function(){
      jQuery( selcter ).text('0');
    }
  });
}

//ポケットのストック数を取得
function get_social_count_pocket(url, selcter) {
  jQuery.ajax({
    type: "get", dataType: "xml",
    url: "http://query.yahooapis.com/v1/public/yql",
    data: {
      q: "SELECT content FROM data.headers WHERE url='https://widgets.getpocket.com/v1/button?label=pocket&count=vertical&v=1&url=" + url + "' and ua='#Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36'",
      format: "xml",
      env: "http://datatables.org/alltables.env"
    },
    success: function (data) {
      var content = jQuery(data).find("content").text();
      var match = content.match(/<em id="cnt">(\d+)<\/em>/i);
      var count = (match != null) ? match[1] : 0;

      jQuery( selcter ).text(count);
    }
  });
}

//feedlyの購読者数を取得
function get_social_count_feedly(rss_url, selcter) {
  jQuery.ajax({
    type: "get", dataType: "json",
    url: "http://query.yahooapis.com/v1/public/yql",
    data: {
      q: "SELECT content FROM data.headers WHERE url='http://cloud.feedly.com/v3/feeds/feed%2F" + encodeURIComponent(rss_url) + "' and ua='#Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36'",
      format: "json",
      env: "http://datatables.org/alltables.env"
    },
    success: function (data) {
      count = data.query.results.resources.content.json['subscribers']
      //console.log(count);

      jQuery( selcter ).text(count);
    }
  });
}

function doMasonry() {
  jQuery('#list').masonry({ //<!-- #listは記事一覧を囲んでる部分 -->
    itemSelector: '.entry', //<!--.entryは各記事を囲んでる部分-->
    isAnimated: true //<!--アニメーションON-->
  });
}

jQuery(function(){
  if (typeof social_count_config !== 'undefined') {
    get_social_count_twitter(social_count_config.permalink, '.twitter-count');
    get_social_count_facebook(social_count_config.permalink, '.facebook-count');
    get_social_count_googleplus(social_count_config.permalink, '.googleplus-count');
    get_social_count_hatebu(social_count_config.permalink, '.hatebu-count');
    get_social_count_pocket(social_count_config.permalink, '.pocket-count');
    get_social_count_feedly(social_count_config.rss2_url, '.feedly-count');
  }

  if (typeof lazyload_config !== 'undefined') {
    jQuery('img').lazyload(lazyload_config);
  }
});

jQuery(window).load(function(){
  if (typeof do_masonry !== 'undefined') {
    doMasonry()
  }
});
jQuery(function(){
  if (typeof do_masonry !== 'undefined') {
    doMasonry()
  }
});
///////////////////////////////////
////レスポンスに表示時のメニューの挙動
///////////////////////////////////
jQuery(function(){
  jQuery(window).resize(function(){
    if ( jQuery(window).width() > 1150 ) {
      jQuery('#navi-in ul').removeAttr('style');
    };
  });
});
