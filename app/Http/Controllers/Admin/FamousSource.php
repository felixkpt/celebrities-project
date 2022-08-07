<?php 
namespace App\Http\Controllers\Admin;
use Goutte\Client;

class FamousSource
{

    public static function getLinks($url) {
        echo "link: $url";
        $client = new Client();

        try {
            $crawler = $client->request('GET', $url);

        }
    catch (\Exception $e) {
        return 'Caught exception: '. $e->getMessage(). "<br>";
        }

//        var_dump($crawler);
// die;

        $title = $crawler->filter('h1.page-title')->each(function ($node) {
            return $node->text();
        })[0];
        

        $title = trim(preg_replace("# Birthdays$#", '', $title));
// var_dump($title);die;

        // Get the people post links
        $links = $crawler->filter('.people-list > .row > a.face')->each(function ($node) {
            // lets check if current node link doesnt exist in links array
            if (strlen($node->attr('href')) > 10 && preg_match('#/people/#', $node->attr('href')))
            {
                return $hrefs[] = $node->attr('href');
            }
        });
        $links = array_filter($links);
        // dd($links);


        shuffle($links);

        return ['links' => $links, 'title' => $title];

    }

    public static function getImages($crawler) {

       $images = $crawler->filter('.col-sm-5.col-md-4.col-lg-4 .img1 .famous-slider img')->each(function ($node) {
            return $node->attr('src');
        });
        if (count($images) == 0) {

            $element_count = $crawler->filter('.col-sm-5.col-md-4.col-lg-4 .img1')->count();

            if ($element_count == 1){
                return $crawler->filter('.col-sm-5.col-md-4.col-lg-4 .img1 img')->each(function ($node) {
                        return $node->attr('src');
                });
            }else {
                return 'No images found.';
            }
        }
        return $images;
    }

    public static function getMainInfo($crawler, $url = null) {
        
        echo "getMainInfo<br>";

         // Get the people post links

        $element_count = $crawler->filter('.main-info')->count();
        if ($element_count == 1) {
            
            $name =  $crawler->filter('.main-info h1')->each(function ($node, $i) {

                return explode('<div', $node->html())[0];

            })[0];
            // var_dump($name);die;

            $title =  $crawler->filter('.main-info div[class="person-title"]')->each(function ($node, $i) {

                if ($node->text())
                    return $node->text();
            });

            if ($title) {
                $title = $title[0];
            }


            //    var_dump($name, $title);die;

            //    getting stats bio Dateofbirth, Birthplace, Age, Birth Sign

                $stats = $crawler->filter('.stats .main-stats .stat.box')->each(function ($node) {
                        $stats = [];
                    if (preg_match('#Birthday#ui', $node->text()) || preg_match('#HAPPY BIRTHDAY#ui', $node->text())) {
                        // die('ddd');
                        $ym = $node->filter('a')->each(function($node, $i) {
                            
                            if ($i == 0) {
                                $month = explode('.', substr($node->attr('href'), strrpos($node->attr('href'), '/') + 1))[0];
                               return $month = date('m-d', strtotime($month));
                                
                            }else {
                                $year = explode('.', substr($node->attr('href'), strrpos($node->attr('href'), '/') + 1))[0];
                                return $year = date('Y', strtotime($year.'-07-01'));
                            }
                            $i++;
                        });

                        $dob = implode('-', array_reverse($ym));
                        $stats['dob'] = date('Y-m-d', strtotime($dob));
                    }elseif (preg_match('#Birthplace#ui', $node->text())) {
                        $parts = explode(', ', preg_replace('#Birthplace #ui', '', $node->text()));
                        $city = $parts[0];
                        $birth_place = $parts[1] ?? '';
                        // dd($city, $birth_place);
                        $stats['city'] = $city;
                        $stats['birth_place'] = $birth_place;
                    }elseif (preg_match('#Age#', $node->text())) {
                        $age = trim($node->text(), 'Age ');
                        $stats['age'] = $age;
                    }elseif (preg_match('#Birth Sign#', $node->text())) {
                        $birth_sign = trim($node->text(), 'Birth Sign ');
                        $stats['birth_sign'] = $birth_sign;
                    }elseif (preg_match('#DEATH DATE#i', $node->text())) {
                        $dod = explode('(', preg_replace('#DEATH DATE#ui', '', $node->text()))[0];
                        $dod = date('Y-m-d', strtotime($dod));
                        $stats['dod'] = $dod;
                    }
                    
                    return $stats;
                    
                });
                $stats = array_reduce($stats, function($out, $cur) {
                    return array_merge($out, $cur);
                }, []);
                // dd($stats);
               

            //                Getting article headers
            $article_headers =  $crawler->filter('.row .bio')->each(function ($node, $i) {

                return $node->filter('h2')->each(function($node) {
                    return $node->text();
                });

            })[0];
            //    var_dump($article_headers);die;

        
            //            Getting article contents
            $article_content =  $crawler->filter('.row .bio')->each(function ($node, $i) {

                return $node->filter('p')->each(function($node) {
                    return strip_tags($node->html());
                });

            })[0];


            //if $article_headers && $article_content get $member_of

            if ($article_headers && $article_content) {

                // Content headers modification
                $find = ['/About/ui', '/Before Fame/ui', '/Trivia/ui', '/Family Life/ui', '/Associated With/ui'];
                $replacement = ['About '.$name, 'Early life of '.$name, 'Trivia', 'Family of '.$name, 'Close associates of '.$name];
                $article_headers = preg_replace($find, $replacement, $article_headers);

                $i = 0;
                $content = array_reduce($article_headers, function($out, $current) use ($article_content, &$i) {
                    $bef = $i > 0 ? "\r\n" : "";
                    $out .= $bef.'<h3 class="person-heading">'.$current."</h3>\r\n".'<p class="person-body">'.$article_content[$i].'</p>';
                    $i++;
                    return $out;
                }, '');
        

                                // Content Body modification
                                // require_once 'article-rewriter.php';
                                // $new_content = [];
                                // foreach ($article_content as $cont) {
                                //     $new_content[] = article_rewriter($cont);
                                // }

            }

            // var_dump($article_headers);die;

            $arr = explode(' ', $name);
            $f_nam = $arr[0];
            $l_nam = $arr[1] ?? '';
            $ret = ['first_name' => $f_nam, 'last_name' => $l_nam, 'professional' => $title, 'content' => $content];
            $ret = array_merge($ret, $stats);
            // dd($ret);
            return $ret;

        }else{
            return 'Main info not found.';
        }

    }



}