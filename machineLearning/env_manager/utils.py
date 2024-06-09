# env_manager/utils.py
import os
from dotenv import load_dotenv, find_dotenv

def load_and_print_env_variables():
    load_dotenv(find_dotenv())

    env_vars = {
        'AICHEM_OPENAI_KEY': os.getenv('AICHEM_OPENAI_KEY'),
        'AICHEM_DB_LOGIN': os.getenv('AICHEM_DB_LOGIN'),
        'AICHEM_DB_USER': os.getenv('AICHEM_DB_USER'),
        'AICHEM_DB_SERVER': os.getenv('AICHEM_DB_SERVER'),
        'AICHEM_DB_DATABASE': os.getenv('AICHEM_DB_DATABASE'),
        'AICHEM_MQTT_LOGIN': os.getenv('AICHEM_MQTT_LOGIN'),
        'AICHEM_MQTT_USER': os.getenv('AICHEM_MQTT_USER'),
        'AICHEM_MQTT_SERVER': os.getenv('AICHEM_MQTT_SERVER'),
        'AICHEM_MQTT_PORT': os.getenv('AICHEM_MQTT_PORT')
    }

    print("Environment variables:")
    for var, value in env_vars.items():
        print(f"{var}: {value}")

if __name__ == "__main__":
    load_and_print_env_variables()
