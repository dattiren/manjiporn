from time import sleep
import MySQLdb                  # pip install mysqlclient
from bs4 import BeautifulSoup   # pip instal beautifulsoup4
import setting as Setting
import urllib.request
import random
import math
import urllib
from selenium import webdriver  # pip install selenium


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
    :type   list
    """

    connect, cursor = db_conect()

    for url_title_obj in movie_url_and_title:
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

            soup = BeautifulSoup(open('html/masutabe_all.html'), 'html.parser')
        else:
            if page_count > 11:
                break
            url = 'https://masutabe.info/all/?p=' + str(page_count)
            html = urllib.request.urlopen(url)
            soup = BeautifulSoup(html, 'html.parser')   # lxmlやhtml5libがインストールされている場合はそっちが優先されるので明示的に指定

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
            soup = BeautifulSoup(open('html/masutabe_detail.html'), 'html.parser')
        else:
            detail_url = 'https://masutabe.info' + video_url
            html = urllib.request.urlopen(detail_url)
            soup = BeautifulSoup(html, 'html.parser')

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

            soup = BeautifulSoup(open('html/sharevideos_all.html'), 'html.parser')
        else:
            if page_count > 21:
                break

            url = 'http://share-videos.se/view/new?uid=1&page=' + str(page_count)
            headers = {
                "User-Agent": "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0",
            }
            request = urllib.request.Request(url=url, headers=headers)
            html = urllib.request.urlopen(request)

            soup = BeautifulSoup(html, 'html.parser')

        articles = soup.select('article.col-sm-3.video_post.postType1')

        # articlesタグが存在しない(動画がない)場合に抜ける
        if len(articles) == 0:
            break

        video_urls = [a.find('a').attrs['href'] for a in articles]

        sleeping()

        movie_url_and_title = share_videos_detail_scraiping(video_urls)

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
            soup = BeautifulSoup(open('html/sharevideos_detail.html'), 'html.parser')

            video_tags = soup.select('#video_tag a')
            movie_url = soup.select('#video_tag a')[-1].attrs['href']

            # if 'youtube.com' in movie_url:
            #     continue

            # mushusei = [tag for tag in video_tags if '無修正' in tag.text]
            # print(mushusei)

            movie_title = ' '.join(([str(video_tag.text) for i, video_tag in enumerate(video_tags) if i != len(video_tags)-1]))
        else:
            target_url = 'http://share-videos.se' + video_url

            web_driver.get(target_url)

            soup = BeautifulSoup(web_driver.page_source, 'html.parser')
            video_tags = soup.select('#video_tag a')

            # 無修正タグが含まれていたら処理をスキップ
            mushusei = [tag for tag in video_tags if '無修正' in tag.text]
            if len(mushusei) != 0:
                continue

            if len(video_tags) == 0:
                continue
            else:
                movie_url = video_tags[-1].attrs['href']

                # リンク先がyoutubeもしくはfc2なら処理をスキップ
                if 'youtube.com' in movie_url or 'fc2.com' in movie_url:
                    continue

                movie_title = ' '.join(([str(video_tag.text) for i, video_tag in enumerate(video_tags) if i != len(video_tags) - 1]))

        movie_url_and_title.append({'title': movie_title, 'url': movie_url})

        sleeping()

    return movie_url_and_title


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


if __name__ == '__main__':
    web_driver = webdriver.PhantomJS()
    TEST_FLAG = False
    main()
