# -*- coding: utf-8 -*-
import pymysql.cursors
import pandas as pd

host = 'den1.mysql6.gear.host'
db = 'situation'
usr = 'situation'
psword = 'cogni88.'

    

 # database connection
connection = pymysql.connect(
    host=host, 
    user=usr, 
    password=psword, 
    database=db, 
    charset="utf8mb4",
    cursorclass=pymysql.cursors.DictCursor,
           )
cursor = connection.cursor()
    
UserId = 'Gerrit'
sql ="SELECT * FROM situation.q17_decarburization_data;"
    
    # with connection.cursor() as cursor:
    #   cursor.execute(sql % UserId)
      
cursor.execute(sql)
        # result for searching Databank
result = cursor.fetchall()
        # change result to dataframe
df_raw = pd.DataFrame(result, columns=[i[0] for i in cursor.description])
      

    # close connection
cursor.close()
connection.close()
 
      
print(df_raw)
   


