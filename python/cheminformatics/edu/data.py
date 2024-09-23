import pymysql
import pandas as pd
from cheminformatics.edu import EDUInstance as BaseEDUInstance

class EDUInstance(BaseEDUInstance):
    def __init__(self, apiKey, RESTURL="http://gressling.net/v2/", db_host=None, db_name=None, db_user=None, db_password=None, db_port=3306):
        super().__init__(apiKey, RESTURL)
        self.db_host = db_host
        self.db_name = db_name
        self.db_user = db_user
        self.db_password = db_password
        self.db_port = db_port
        self.connection = None

    def connect_db(self):
        """Connect to the MySQL database."""
        try:
            self.connection = pymysql.connect(
                host=self.db_host,
                port=self.db_port,  # 添加了 port 参数
                user=self.db_user,
                password=self.db_password,
                database=self.db_name,
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
