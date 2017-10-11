# ますたべ
# すべてから無修正タグ、タイトルを除く
# 詳細画面へ遷移し、そのページのリザーブurlを取得して保存


import MySQLdb                  # pip install mysqlclient
from bs4 import BeautifulSoup   # pip instal beautifulsoup4
import setting as Setting
import urllib.request


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


def hoge(connect, cursor):
    cursor.execute('select * from admin_users;')

    for row in cursor:
        print(row[0],row[1])




def main():
    connect, cursor = db_conect()
    hoge(connect, cursor)
    db_close(connect, cursor)


if __name__ == '__main__':
    main()
