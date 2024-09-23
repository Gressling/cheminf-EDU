import pymysql
import pandas as pd
import getpass  # 导入getpass模块
from cheminformatics.edu.base import BaseEDUInstance  # 从 base.py 导入

class DBEDUInstance(BaseEDUInstance):
    def __init__(self, apiKey, RESTURL="http://gressling.net/v2/", db_host=None, db_name=None, db_user=None, db_password=None, db_port=3306):
        super().__init__(apiKey, RESTURL)
        self.db_host = db_host
        self.db_name = db_name
        self.db_user = db_user
        self.db_password = db_password  # db_password 仍然是一个可选参数
        self.db_port = db_port
        self.connection = None

    def connect_db(self):
        """Connect to the MySQL database, prompting for password if not provided."""
        if not self.db_password:  # 如果没有提供密码，则提示用户输入
            self.db_password = getpass.getpass(prompt="Please enter your MySQL password: ")

        try:
            self.connection = pymysql.connect(
                host='den1.mysql6.gear.host',
                port=3306,
                user='situation',
                password=self.db_password,  # 使用用户输入的密码
                database='situation',
                cursorclass=pymysql.cursors.DictCursor
            )
            return True
        except pymysql.Error as err:
            print(f"Database connection failed, error code {err.args[0]}: {err.args[1]}")
            return False

    def getQueryTable(self, table_name):
        """Retrieve data from a specific MySQL table and return it as a DataFrame."""
        if self.connect_db():
            sql = f"SELECT * FROM {table_name};"
            try:
                with self.connection.cursor() as cursor:
                    cursor.execute(sql)
                    result = cursor.fetchall()
                return pd.DataFrame(result)
            except pymysql.Error as err:
                print(f"Error occurred during query, error code {err.args[0]}: {err.args[1]}")
                return None
            finally:
                self.connection.close()
        else:
            return "Database connection failed"
