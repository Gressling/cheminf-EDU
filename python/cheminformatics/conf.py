# Configuration file for the Sphinx documentation builder.
#
# For the full list of built-in configuration values, see the documentation:
# https://www.sphinx-doc.org/en/master/usage/configuration.html

# -- Project information -----------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#project-information

project = 'cheminformatics'
copyright = ' - no copyright (CC0)'
author = 'Gressling, Thorsten et al.'
release = '2024'

# -- General configuration ---------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#general-configuration

extensions = ['sphinx.ext.autodoc']

templates_path = ['_templates']
exclude_patterns = []

# -- Options for HTML output -------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#options-for-html-output

# html_theme = 'alabaster'
# html_theme = "sphinx_rtd_theme"
# html_static_path = ['_static']

import os
import sys
sys.path.insert(0, os.path.abspath('../'))

# Assuming your documentation is in 'docs' and your code is in the parent directory
os.system('sphinx-apidoc -o docs/ ../cheminformatics -f')
