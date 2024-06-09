# env_manager/get_env.py
# !pip install python-dotenv

import os
from dotenv import load_dotenv, find_dotenv

def get_env_variable(var_name):
    value = os.getenv(var_name)
    if value is None:
        value = input(f"{var_name} is not set. Please enter the value for {var_name}: ")
        os.environ[var_name] = value
    return value

def read_env_variables():
    load_dotenv(find_dotenv())

    env_vars = [
        'AICHEM_OPENAI_KEY',
        'AICHEM_DB_LOGIN',
        'AICHEM_DB_USER',
        'AICHEM_DB_SERVER',
        'AICHEM_DB_DATABASE',
        'AICHEM_MQTT_LOGIN',
        'AICHEM_MQTT_USER',
        'AICHEM_MQTT_SERVER',
        'AICHEM_MQTT_PORT'
    ]

    for var in env_vars:
        value = get_env_variable(var)
        print(f"{var}: {value}")

if __name__ == "__main__":
    read_env_variables()
