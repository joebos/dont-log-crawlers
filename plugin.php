<?php
/**
Plugin Name: Don't Log Crawlers
Plugin URI: https://github.com/luixxiul/dont-log-crawlers
Description: Prevents YOURLS from counting clicks of crawlers & bots with specific User Agent strings
Version: 1.2
Author: Suguru Hirahara
Author URI: http://www.philosophyguides.org
**/

function dlb_is_crawler() {
    
    //set to 1 to be more agressive in filtering
    //adds 'curl', wget', 'ruby' and 'bot'
    $dont_log_aggressive = 1;
    
    // Get current User-Agent
    $current = strtolower( $_SERVER['HTTP_USER_AGENT'] );
    
    $crawlers = array(
        // List of Active crawlers & bots since October 2013 (incomplete)
        // picked up from: http://user-agent-string.info/list-of-ua/bots
        // also: http://myip.ms/browse/web_bots/Known_Web_Bots_Web_Bots_2014_Web_Spider_List.html
        '200please.com/bot',
        '360spider',
        '80legs.com/webcrawler',
        'a6-indexer',
        'aboundex',
        'aboutusbot',
        'addsearchbot',
        'addthis.com',
        'adressendeutschland.de',
        'adsbot-google',
        'ahrefsbot',
        'aihitbot',
        'alexa site audit',
        'amznkassocbot',
        'analyticsseo.com',
        'applebot',
        'antbot',
        'arabot',
        'archive.org_bot',
        'archive.orgbot',
        'askpeterbot',
        'backlinkcrawler',
        'baidu.com/search/spider.html',
        'baiduspider',
        'begunadvertising',
        'bingbot',
        'bingpreview',
        'bitlybot',
        'bixocrawler',
        'blekkobot',
        'blexbot',
        'brainbrubot',
        'browsershots',
        'bubing',
        'butterfly',
        'bufferbot',
        'careerbot',
        'catchbot',
        'ccbot',
        'cert figleafbot',
        'changedetection.com/bot.html',
        'chilkat',
        'claritybot',
        'classbot',
        'cliqzbot',
        'cms crawler',
        'coccoc',
        'compspybot',
        'crawler4j',        
        'crowsnest',
        'crystalsemanticsbot',
        'dataminr.com',
        'daumoa',
        'digg',
        'easouspider',
        'exabot',
        'exb language crawler',
        'ezooms',
        'Facebot',
        'facebookexternalhit',
        'facebookplatform',
        'fairshare',
        'feedfetcher',
        'feedly.com/fetcher.html',
        'feedlybot',
        'fetch',
        'flipboardproxy',
        'fyberspider',
        'genieo',
        'gigabot',
        'google page speed insights',
        'googlebot',
        'grapeshot',
        'hatena-useragent',
        'hubspot connect',
        'hubspot links crawler',
        'hosttracker.com',
        'ia_archiver',
        'icc-crawler',
        'ichiro',
        'immediatenet.com',
        'iltrovatore-setaccio',
        'infohelfer',
        'instapaper',
        'ixebot',
        'jabse.com crawler',
        'james bot',
        'jikespider',
        'jyxobot',
        'linkdex',
        'linkfluence',
        'loadimpactpageanalyzer',
        'longurl',
        'luminate.com',
        'lycosa',
        'magpie-crawler',
        'mail.ru_bot',
        'meanpathbot',
        'mediapartners-google',
        'metageneratorcrawler',
        'metajobbot',
        'metauri',
        'mj12bot',
        'mojeekbot',
        'msai.in',
        'msnbot-media',
        'musobot',
        'najdi.si',
        'nalezenczbot',
        'nekstbot',
        'netcraftsurveyagent',
        'netestate ne crawler',
        'netseer crawler',
        'nuhk',
        'obot',
        'omgilibot',
        'openwebspider',
        'panscient.com',
        'parsijoo',
        'plukkie',
        'proximic',
        'psbot',
        'qirina hurdler',
        'qualidator.com',
        'queryseekerspider',
        'readability',
        'rogerbot',
        'sbsearch',
        'scrapy',
        'search.kumkie.com',
        'searchbot',
        'searchmetricsbot',
        'semrushbot',
        'seocheckbot',
        'seoengworldbot',
        'seokicks-robot',
        'seznambot',
        'shareaholic.com/bot',
        'shopwiki.com/wiki/help:bot',
        'showyoubot',
        'sistrix',
        'sitechecker',
        'siteexplorer',
        'speedy spider',
        'socialbm_bot',
        'sogou web spider',
        'sogou',
        'sosospider',
        'spbot',
        'special_archiver',
        'spiderling',
        'spinn3r',
        'spreadtrum',
        'ssl-crawler',
        'steeler',
        'SubnetSearch',
        'suma spider',
        'surveybot',
        'suggybot',
        'svenska-webbsido',
        'teoma',
        'thumbshots',
        'tineye.com',
        'trendiction.com',
        'trendiction.de/bot',
        'turnitinbot',
        'tweetedtimes',
        'tweetmeme',
        'twitterbot',
        'uaslinkchecker',
        'umbot',
        'undrip bot',
        'unisterbot',
        'unwindfetchor',
        'urlappendbot',
        'vedma',
        'vkshare',
        'voilabot',
        'wbsearchbot',
        'wch web spider',
        'webcookies',
        'webcrawler at wise-guys dot nl',
        'webthumbnail',
        'wesee:search',
        'woko',
        'woobot',
        'woriobot',
        'wotbox',
        'y!j-bri',
        'y!j-bro',
        'y!j-brw',
        'y!j-bsc',
        'yacybot',
        'yahoo! slurp',
        'yahooysmcm',
        'yandexbot',
        'yats',
        'yeti',
        'yioopbot',
        'yodaobot',
        'youdaobot',
        'zb-1',
        'zeerch.com/bot.php',
        'zing-bottabot',
        'zumbot',

        // accessed when tweeted
        'ning/1.0',
        'yahoo:linkexpander:slingstone',
        'google-http-java-client/1.17.0-rc (gzip)',
        'js-kit url resolver',
        'htmlparser',
        'paperlibot',
        
        // xenu
        'xenu link sleuth',

	'nuzzel',
	'something',
	'metauri.com',
	'dataminr.com',
	'linkfluence.com',
	'-',
	'mailto',
	'ysearch',
	'everyonesocial.com',
	'robot',
	'support.paper.li',
	'Mozilla/5.0 (X11; U; Linux i686; it; rv:',

    );
    
    if ($dont_log_aggressive == 1) {
    
        $crawlers[] = 'bot';
        $crawlers[] = 'ruby';
        $crawlers[] = 'curl';
        $crawlers[] = 'wget';
    
    }
    
    // Check if the UA string contains any strings listed above
    $is_crawler = ( str_ireplace( $crawlers, '',$current ) != $current );
    
    return $is_crawler;
}

// Hook stuff in
yourls_add_filter( 'shunt_update_clicks','dlb_skip_if_crawler' );
yourls_add_filter( 'shunt_log_redirect','dlb_skip_if_crawler' );

// Skip if crawler
function dlb_skip_if_crawler() {
    return dlb_is_crawler();
    // if anything but false is returned, functions using the two shunt_* filters will be short-circuited
}
