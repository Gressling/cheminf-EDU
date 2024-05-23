import pandas as pd
import pymysql.cursors
from typing import Union, List


HOST = "den1.mysql6.gear.host"
DB = "situation"
USR = "situation"
PASSWORD = "cogni88."
TABLE = "p16_drug_target_data"
SQL = f"SELECT * FROM {TABLE}"


def connect_to_database() -> pymysql.Connection:
    try:
        connection = pymysql.connect(
            host=HOST,
            user=USR,
            password=PASSWORD,
            database=DB,
            cursorclass=pymysql.cursors.DictCursor,
        )
        return connection
    except pymysql.Error as e:
        print(f"There's been an error: {e.args[0], e.args[1]}")
        raise


def query_data(
    connection: pymysql.Connection, type: str = "sql"
) -> Union[list[object], pd.DataFrame]:
    if type == "sql":
        try:
            with connection.cursor() as cursor:
                cursor.execute(SQL)
                res = cursor.fetchall()  # get results
                return res
        except pymysql.Error as e:
            print(f"There has been an error: {e.args[0], e.args[1]}")
            return []

    elif type == "dataframe":
        try:
            res = pd.read_sql(sql=SQL, con=connection)
            return res
        except Exception as e:
            print(e)
            return []

    else:
        print("Type not found.")
        return []
