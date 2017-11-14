from time import sleep
import MySQLdb                  # pip install mysqlclient
from bs4 import BeautifulSoup   # pip instal beautifulsoup4
import setting as Setting
import urllib.request
import random
import math
import urllib.parse
from selenium import webdriver  # pip install selenium
import re


def db_conect():
    connect = MySQLdb.connect(
        host=Setting.HOST,
        user=Setting.USERNAME,
        passwd=Setting.PASSWORD,
        db=Setting.DB_NAME,
        charset=Setting.CHARSET
    )

    cursor = connect.cursor()

    return connect, cursor


def db_close(connect, cursor):
    cursor.close()
    connect.close()


def save_data(movie_url_and_title):
    """
    動画URLとタイトルを受け取って保存を行う

    :param  movie_url_and_title: 動画URLとタイトルのdictが格納された1次元配列
    :type   movie_url_and_title: list
    """

    connect, cursor = db_conect()

    for url_title_obj in movie_url_and_title:
        # TODO DB設計が済んだのちに、カラム名を修正
        cursor.execute('INSERT INTO movies(title, url, play_count) VALUES(%s, %s, %s)', (url_title_obj['title'], url_title_obj['url'], 0))

    connect.commit()

    db_close(connect, cursor)


def masutabe_scraiping():
    """
    マスタベのスクレイピングを実行して、データベースへ動画URLとタイトルを保存する
    """

    page_count = 1

    while True:
        if TEST_FLAG:
            if page_count > 1:
                break

            soup = get_soup('html/masutabe_all.html')
        else:
            if page_count > 11:
                break

            soup = get_soup('https://masutabe.info/all/?p=' + str(page_count))

        # h2タグ内にあるaタグを抽出
        h2_tags = [h2.find('a') for h2 in soup.find_all('h2') if h2.find('a') is not None]

        # h2タグが存在しない(動画がない)場合に抜ける
        if len(h2_tags) == 0:
            break

        # aタグのhref属性を抽出
        video_urls = [a.attrs['href'] for a in h2_tags]

        print(video_urls)

        sleeping()

        movie_url_and_title = masutabe_detail_scraiping(video_urls)

        save_data(movie_url_and_title)

        sleeping()

        print('page ' + str(page_count) + ' is done.')

        page_count += 1


def masutabe_detail_scraiping(video_urls):
    """
    動画詳細ページから、動画URLとタイトルを抽出する

    :param   video_urls: 動画詳細のURL(マスタベ内)
    :type    video_urls: list

    :return: 動画URLとタイトルのdict配列
    :rtype:  list
    """

    movie_url_and_title = []

    for video_url in video_urls:
        if TEST_FLAG:
            soup = get_soup('html/masutabe_detail.html')
        else:
            soup = get_soup('https://masutabe.info' + video_url)

        movie_url = soup.find('iframe').attrs['src']
        movie_tags = soup.select('ul.tag_list')[0]
        movie_title = [movie_title.text for movie_title in soup.find_all('h1') if movie_title.text != ''][0]

        # 無修正かをタグとタイトルから判断
        if '無修正' in movie_tags.text or '無修正' in movie_title:
            continue

        movie_url_and_title.append({'title': movie_title, 'url': movie_url})

        print(movie_url_and_title)

        sleeping()

    return movie_url_and_title


def share_videos_scraiping():
    """
    share_videosのスクレイピングを実行して、データベースへ動画URLとタイトルを保存する
    """

    page_count = 1

    while True:
        if TEST_FLAG:
            if page_count > 1:
                break

            soup = get_soup('html/sharevideos_all.html')
        else:
            if page_count > 21:
                break

            soup = get_soup('http://share-videos.se/view/new?uid=1&page=' + str(page_count))

        articles = soup.select('article.col-sm-3.video_post.postType1')

        # articlesタグが存在しない(動画がない)場合に抜ける
        if len(articles) == 0:
            break

        video_urls = [a.find('a').attrs['href'] for a in articles]

        # sleeping()

        movie_url_and_title = share_videos_detail_scraiping(video_urls)

        print(movie_url_and_title)

        save_data(movie_url_and_title)

        sleeping()

        print('page ' + str(page_count) + ' is done.')

        page_count += 1


def share_videos_detail_scraiping(video_urls):
    """
    share videosの動画詳細ページから、動画URLとタイトルを抽出する

    :param    video_urls: 動画詳細のURL(share videos内)
    :type     video_urls: list

    :return:  動画URLとタイトルのdict配列
    :rtype:   list
    """

    movie_url_and_title = []

    for video_url in video_urls:
        if TEST_FLAG:
            soup = get_soup('html/sharevideos_detail.html')

            video_tags = soup.select('#video_tag a')
            movie_url = soup.select('#video_tag a')[-1].attrs['href']

            movie_title = ' '.join(([str(video_tag.text) for i, video_tag in enumerate(video_tags) if i != len(video_tags)-1]))
        else:
            target_url = 'http://share-videos.se' + video_url

            web_driver.get(target_url)

            soup = BeautifulSoup(web_driver.page_source, 'html.parser')
            video_tags = soup.select('#video_tag a')

            # 無修正タグが含まれていたら処理をスキップ
            mushusei = [tag for tag in video_tags if '無修正' in tag.text]
            if len(mushusei) != 0:
                print('mushusei skip')
                continue

            if len(video_tags) == 0:
                print('video_tags is 0 skip')
                continue

            movie_url = video_tags[-1].attrs['href']

            # リンク先がyoutubeもしくはfc2なら処理をスキップ、javynowはそのまま、それ以外は個別に取得処理を実施
            if 'youtube.com' in movie_url or 'fc2.com' in movie_url:
                print('youtube.com or fc2.com skip')
                continue
            elif 'javynow.com' in movie_url:
                pass
            else:
                print('**** get_iframe_link ****')
                movie_url = get_iframe_link(movie_url)
                print(movie_url)

            movie_title = ' '.join(([str(video_tag.text) for i, video_tag in enumerate(video_tags) if i != len(video_tags) - 1]))

        movie_url_and_title.append({'title': movie_title, 'url': movie_url})

        sleeping()

    return movie_url_and_title


def kyonyudouga_stream_scraping():
    """
    巨乳動画ストリームのスクレイピングを実行して、データベースへ動画URLとタイトルを保存する
    """

    page_count = 1

    while True:
        if TEST_FLAG:
            if page_count > 1:
                break

            soup = get_soup('html/kyonyu_all.html')
        else:
            if page_count > 6:
                break

            soup = get_soup('http://kyonyudouga.com/page/' + str(page_count))

        posts = soup.find_all('div', class_="posts")
        a_tags = [post.find('a') for post in posts]

        movie_titles = [a.attrs['title'] for a in a_tags]
        movie_urls = [a.attrs['href'] for a in a_tags]

        sleeping()

        movie_iframe_urls, tags = kyonyudouga_stream_detail_scraping(movie_urls)

        movie_obj_list = [{'tags': tag_list, 'title': movie_title, 'url': movie_url} for movie_title, movie_url, tag_list in zip(movie_titles, movie_iframe_urls, tags)]

        save_data(movie_obj_list)

        sleeping()

        print('page ' + str(page_count) + ' is done.')

        page_count += 1


def kyonyudouga_stream_detail_scraping(video_urls):
    """
   巨乳動画ストリームの動画詳細ページから、動画URLを抽出する

   :param    video_urls: 動画詳細のURL(share videos内)
   :type     video_urls: list

   :returns: url, タグ
   :rtype:   list
   """

    movie_urls = []
    tags = []

    for video_url in video_urls:
        if TEST_FLAG:
            soup = get_soup('html/kyonyu_detail.html')
        else:
            soup = get_soup(video_url)

        # iframe用のリンクを取得
        movie_urls.append(soup.find('iframe').attrs['src'])

        # TODO 本番でも同様にタグを取得することができるか検証
        # タグを取得
        tags.append([a_tag.text for a_tag in soup.find('li', id='the_tags').find_all('a')])

        sleeping()

    return movie_urls, tags


def pornhub_scraping():
    """
    pornhubのスクレイピングを実行して、データベースへ動画URLとタイトルを保存する
    """

    page_count = 1
    # TODO 英語版に切り替える
    base_url = 'https://jp.pornhub.com/view_video.php?viewkey='

    while True:

        movie_urls = []

        if TEST_FLAG:
            if page_count > 1:
                break

            soup = get_soup('html/pornhub_all.html')
        else:
            if page_count > 21:
                break

            soup = get_soup('https://jp.pornhub.com/video?o=mv&cc=jp&page=' + str(page_count))

        video_area = soup.find('ul', class_='nf-videos videos search-video-thumbs')
        video_li_tags = video_area.find_all('li')

        # ビデオタグ内から、再生回数5万回以上かつ日本語タイトルのビデオを抽出
        for video_li_tag in video_li_tags:
            view_count_text = video_li_tag.find('span', class_='views').text.replace(',', '')
            view_count_int = int(re.search('[0-9]+', view_count_text).group(0))

            movie_title = video_li_tag.find('a').attrs['title']

            m = re.search('[一-龥ぁ-んァ-ンぁ-んァ-ン]+', movie_title)

            # 日本語が含まれており、再生数が5万以上のみ処理を実行
            if m and view_count_int > 50000:
                # TODO 英語版にアクセスしていけるか検証
                movie_urls.append(base_url + video_li_tag.attrs['_vkey'])


        movie_obj = pornhub_detail_scraping(movie_urls)

        save_data(movie_obj)

        print('page ' + str(page_count) + ' is done.')

        page_count += 1

        sleeping()


def pornhub_detail_scraping(movie_urls):

    movie_obj_list = []

    for url in movie_urls:

        sleeping()

        category_list = []

        if TEST_FLAG:
            soup = get_soup('html/pornhub_detail.html')
        else:
            soup = get_soup(url)

        #  カテゴリーの抽出
        # TODO 本番でも同様に抽出できるか検証
        for category in soup.select('.categoriesWrapper a'):
            if 'onclick' in category.attrs:
                category_list.append(category.text)

        # print(category_list)

        # タイトルの抽出
        title = ''
        for meta in soup.find_all('meta'):
            if 'name' in meta.attrs and meta.attrs['name'] == 'twitter:title':
                title = meta.attrs['content']
                break

        movie_obj_list.append({
            'title': title,
             'url': get_iframe_link(url),
             'tags': category_list
        })

    return movie_obj_list


def get_soup(url):
    """
    指定されたurlのsoupオブジェクトを返す関数

    :param url: 取得したいurl
    :type  url: str

    :return:    指定されたurlのsoupオブジェクト
    :rtype:     object
    """

    if TEST_FLAG:
        return BeautifulSoup(open(url), 'html.parser')  # lxmlやhtml5libがインストールされている場合はそっちが優先されるので明示的に指定
    else:
        headers = {
            "User-Agent": "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0",
        }

        request = urllib.request.Request(url=url, headers=headers)
        html_content = urllib.request.urlopen(request)

        return BeautifulSoup(html_content, 'html.parser')


def get_iframe_link(movie_url):
    """
    動画の詳細ページのURLをiframe対応済みのURLへ変換する

    :param movie_url: 動画の詳細(動画が載っている)ページのURL
    :type  movie_url: str

    :return: iframe対応済みのリンク or 空文字
    :rtype: str
    """

    parse_result = urllib.parse.urlparse(movie_url)
    query_set = urllib.parse.parse_qs(parse_result.query)

    if 'xvideos.com' in movie_url:
        return 'https://flashservice.xvideos.com/embedframe' + parse_result.path
    elif 'pornhub.com' in movie_url:
        return 'https://jp.pornhub.com/embed/' + query_set['viewkey'][0]
    elif 'redtube.com' in movie_url:
        return 'https://embed.redtube.com/?id=' + parse_result.path.replace('/', '')
    elif 'thisav.com' in movie_url:
        return 'http://www.thisav.com' + parse_result.path.replace('video/', 'video/embed/')
    elif 'smv.to' in movie_url:
        return 'http://smv.to/' + parse_result.path.replace('detail', 'embed')
    elif 'gotporn.com' in movie_url:
        m = re.search('[0-9]+$', parse_result.path)

        if m:
            return 'https://www.gotporn.com/video/' + m.group(0) + '/embedframe'
        else:
            return ''

    elif 'jp.vjav.com' in movie_url:
        m = re.search('[0-9]+$', parse_result.path)

        if m:
            return 'https://xhamster.com/xembed.php?video=' + m.group(0)
        else:
            return ''

    elif 'youporn.com' in movie_url:
        return movie_url.replace('watch', 'embed')
    else:
        return ''


def get_random_int(min_sec, max_sec):
    """
    指定したmin_secからmax_secまでの値をランダムに返す

    :param min_sec: 生成したい最小値
    :type  min_sec: int
    :param max_sec: 生成したい最大値
    :type  max_sec: int

    :return:        指定した範囲のランダム値
    :rtype:         int
    """

    return math.floor(random.random() * (max_sec - min_sec + 1)) + min_sec


def sleeping():
    """
    sleepを実行しつつメッセージも表示する
    """

    print('sleeping')
    sleep(get_random_int(5, 10))
    print('finish sleep')


def main():
    # masutabe_scraiping()
    share_videos_scraiping()
    # kyonyudouga_stream_scraping()
    # pornhub_scraping()


if __name__ == '__main__':
    web_driver = webdriver.PhantomJS()
    TEST_FLAG = True

    main()

    web_driver.close()
    web_driver.quit()
