import os
import sys
sys.path.insert(0, os.path.abspath('../python'))

project = 'cheminf-EDU'
author = 'Ziheng Zhao'
release = '1.0'

extensions = [
    'sphinx.ext.autodoc',
    'sphinx.ext.napoleon',
]

html_theme = 'sphinx_rtd_theme'
