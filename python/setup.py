from setuptools import setup, find_packages

# https://pypi.org/search/?q=gressling

setup(
    name='gressling',
    version='0.0.2',
    packages=find_packages(),
    install_requires=[],
    author='Gressling, T.',
    author_email='thorsten.gressling@gressling.com',
    description='A simple example package',
    long_description=open('README.md').read(),
    long_description_content_type='text/markdown',
)
