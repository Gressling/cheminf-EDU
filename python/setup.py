from setuptools import setup, find_packages

setup(
    name="Cheminformaticsedu",  
    version="1.0.3",  
    author="Ziheng Zhao",
    author_email="zhacisbw4801@gmail.com",
    description="chemie education cooperate with ai",
    long_description=open('README.md').read(), 
    long_description_content_type="text/markdown",  
    url="https://github.com/Yakimochinai/che-edu",  
    packages=find_packages(),  
    classifiers=[
        "Programming Language :: Python :: 3",
        "License :: OSI Approved :: MIT License",
        "Operating System :: OS Independent",
    ],
    python_requires='>=3.6',  
)
