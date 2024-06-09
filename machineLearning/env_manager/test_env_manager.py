# env_manager/main.py
# !pip install python-dotenv

from env_manager import set_env, get_env

def main():
    print("Setting environment variables...")
    set_env.set_env_variables()

    print("\nReading environment variables...")
    get_env.read_env_variables()

if __name__ == "__main__":
    main()
