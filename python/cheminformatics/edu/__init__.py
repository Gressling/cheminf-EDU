import warnings
import requests
import pandas as pd

class EDUInstance:
    def __init__(self, apiKey, RESTURL="http://gressling.net/v2/"):
        self.apiKey = apiKey
        self.RESTURL = RESTURL
        self.session = requests.Session()

    def connect(self):
        """Checks connection to the API by verifying if the status code is 200."""
        url = f"{self.RESTURL}api.php"
        query = {"apiKey": self.apiKey}
        try:
            response = self.session.get(url, params=query)
            return response.status_code == 200
        except requests.RequestException as e:
            print(f"An error occurred: {e}")
            return False

    def testAccess(self):
        """Retrieves data from the API if connection is successful."""
        if self.connect():
            url = f"{self.RESTURL}api.php"
            query = {"apiKey": self.apiKey}
            response = self.session.get(url, params=query)
            return response.json()
        else:
            return "Connection failed"

    def getExperiments(self):
        """Retrieves data from the API if connection is successful."""
        if self.connect():
            url = f"{self.RESTURL}A1/A1.php"
            query = {"apiKey": self.apiKey}
            response = self.session.get(url, params=query)
            json_data = response.json()
            return pd.DataFrame(json_data['data'])
        else:
            return "Connection failed"
