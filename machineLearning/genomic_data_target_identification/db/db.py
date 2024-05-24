import os
import pandas as pd
import pymysql.cursors
from typing import Union, List
from dotenv import load_dotenv

try:
    load_dotenv()
    HOST = os.getenv("HOST")
    DB = os.getenv("DB")
    USR = os.getenv("USR")
    PASSWORD = os.getenv("PASSWORD")
    TABLE = os.getenv("TABLE")
    SQL = f"SELECT * FROM {TABLE}"
except Exception as e:
    print(
        f"Can not load .env file. Make sure you created a .env file in the db folder. Refer to the README.md for help.\nError:{e}"
    )


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


if __name__ == "__main__":
    con = connect_to_database()
    d = query_data(con, "sql")
    print(d)
