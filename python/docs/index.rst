Welcome to Cheminf-EDU's documentation!
=========================================

Cheminf-EDU is an educational project for cheminformatics, aimed at helping students and researchers better understand the processing and analysis of chemical data. This project includes multiple modules covering the complete workflow from data acquisition to analysis.

Installation
============

To install this project, please run the following command:

pip install Cheminfoedu



Usage
=====

Here’s a basic example of how to use this project:



```python

import cheminf_edu



Example code
=====


Here are some examples of using this project:



! pip install matplotlib

! pip install numpy

! pip install numpy

! pip install seaborn

import pandas as pd

import numpy as np

import matplotlib.pyplot as plt

import seaborn as sns

! pip install Cheminfoedu --force-reinstall --index-url https://pypi.org/simple

! pip install python-dotenv

import os

import pandas as pd

from dotenv import load_dotenv, find_dotenv

from cheminformatics.edu import EDUInstance


load_dotenv(find_dotenv())

table_name = 'h8_chemical_inventory_usage'

apiKey = os.getenv('AICHEM_API_KEY')

if apiKey is None:

    apiKey = input("API key is not set. Please enter the API key: ")

edu_instance = EDUInstance(apiKey=apiKey)

response = edu_instance.testAccess()

data_frame = edu_instance.getExperiments(table_name)

print (data_frame)

data_list = []

if isinstance(data_frame, dict) and 'data' in data_frame:

    data_list = data_frame['data']

df = pd.DataFrame(data_list)

if not df.empty:

    print(df.to_string(index=False, header=['id', 'amount_taken', 'unit', 'location', 'chemical', 'CAS', 'reason'], justify='center'))

else:

    print("No data available.")





Frequently Asked Questions
=====
Q: How do I resolve errors encountered during installation? A: Please ensure you are using a compatible version of Python and check the project’s GitHub issues page.

Q: Does the project support Windows and Linux? A: Yes, this project is compatible with both Windows and Linux environments.

Contributing
Contributions are welcome! Please refer to the CONTRIBUTING.md file for more information.

License
=====
This project is licensed under the MIT License.

Contact
=====
If you have any questions, please contact zhacisbw4801@gmail.com

Changes Made:
=====
- All content is now in English.

Feel free to modify this file further as needed. If you have any other questions or need additional assistance, just let me know!
